<?php


  namespace Modules\Gallery\Http\Controllers\Back;


  use Illuminate\Http\Request;
  use Modules\Gallery\Models\Album;
  use Illuminate\Routing\Controller;
  use Illuminate\Support\Facades\DB;
  use Modules\Gallery\Models\AlbumImage;
  use Illuminate\Support\Facades\Storage;
  use App\Repositories\Contracts\ActivityLogContract;
  use Modules\Gallery\Repositories\Contracts\AlbumContract;
  use Modules\Gallery\Repositories\Contracts\AlbumImageContract;

  class AlbumController extends Controller
  {
    public $albumContract, $activityContract, $imageContract;

    public function __construct(AlbumContract $albumContract,AlbumImageContract $imageContract, ActivityLogContract $activityContract)
    {
      $this->albumContract = $albumContract;
      $this->activityContract = $activityContract;
      $this->imageContract = $imageContract;
    }

    public function index(){
      return view('gallery::back.albums.index');
    }

    public function getAlbumData(Request $request) {
      if(!$request->ajax()){
        abort(404);
      }
      $columns = array(
        0 => 'id',
        1 => 'name',
        2 => 'album_code',
        3 => 'description',
        4 => 'tags',
        5 => 'created_by',
        6 => 'updated_by',
        7 => 'created_at',
        8 => 'actions'
      );
      $totalData = Album::count();
      $totalFiltered = $totalData;
      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');
      if (empty($request->input('search.value'))) {
        if(($request->input('order.0.column') == 0) && $request->input('order.0.dir') == 'asc'){
          if($limit == -1){
            $albums = Album::orderBy('created_at', 'desc')
              ->get();
          } else {
            $albums = Album::offset($start)
              ->limit($limit)
              ->orderBy('created_at', 'desc')
              ->get();
          }

        } else {
          if($limit == -1){
            $albums = Album::orderBy($order, $dir)
              ->get();
          } else {
            $albums = Album::offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();
          }

        }
      } else {
        $search = $request->input('search.value');
        if($limit == -1){
          $albums = Album::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orWhere('tags', 'LIKE', '%' . $search . '%')
            ->orderBy($order, $dir)
            ->get();
        } else {
          $albums = Album::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orWhere('tags', 'LIKE', '%' . $search . '%')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        }
        $totalFiltered = Album::where('name', 'LIKE', '%' . $search . '%')
          ->orWhere('description', 'LIKE', '%' . $search . '%')
          ->orWhere('tags', 'LIKE', '%' . $search . '%')
          ->count();
      }
      $data = array();
      if (!empty($albums)) {

        $c = 1;
        foreach ($albums as $album) {
          $edit = route('albums.edit', encrypt($album->id));
          $delete = route('albums.show', encrypt($album->id));

          $nestedData['id'] = $c;
          $nestedData['name'] = $album->name;
          $nestedData['album_code'] = $album->album_code;
          $nestedData['description'] = $album->description;
          $nestedData['tags'] = $album->tags;
          $nestedData['created_by'] = $album->createdBy->name;
          $nestedData['updated_by'] = (isset($album->updated_by))?$album->updatedBy->name:'-';
          $nestedData['created_at'] = $album->created_at->toDateTimeString();
          $nestedData['actions'] = '<div class="button-items">';
          if(auth()->user()->can('update gallery albums')){
            $nestedData['actions'] .= '<a href="'.$edit.'" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Update</a>';
          }
          if(auth()->user()->can('delete gallery albums')){
            $nestedData['actions'] .= ' <a href="'.$delete.'" type="button" class="btn btn-sm btn-secondary waves-effect waves-light">View</a>';
          }
          $nestedData['actions'] .= '</div>';
          $c++;
          $data[] = $nestedData;

        }

      }
      $json_data = array(
        "draw" => intval($request->input('draw')),
        "recordsTotal" => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        "data" => $data
      );
      echo json_encode($json_data);
    }

    public function create()
    {
      return view('gallery::back.albums.create');
    }

    public function store(Request $request)
    {
      try{
        DB::beginTransaction();
        $album = $this->albumContract->create([
          'name'=>$request->name,
          'description'=>$request->description,
          'album_code'=>strtolower(uniqid()),
          'tags'=>$request->tags
        ]);
        $this->activityContract->create([
          'entity_id'=>$album->id,
          'entity_type'=>'Gallery Album',
          'activity'=>'Album with name '.$album->name.' created',
          'link'=>route('albums.index'),
          'type'=>'green'
        ]);
        DB::commit();
        return redirect()
          ->route('albums.show',encrypt($album->id))
          ->with('success','Album created successfully.');
      } catch (\Exception $e){
        DB::rollBack();
        return redirect()
          ->back()
          ->withInput()
          ->with('warning','Error: '.$e->getMessage());
      }
    }

    public function show($id)
    {
      $album = $this->albumContract->find(decrypt($id));
      return view('gallery::back.albums.show',compact('album'));
    }

    public function edit($id)
    {
      $album = $this->albumContract->find(decrypt($id));
      return view('gallery:back.albums.edit',compact('album'));
    }

    public function update(Request $request,$id)
    {
      $album = $this->albumContract->find(decrypt($id));
      try{
        DB::beginTransaction();
        $album = $this->albumContract->update($album->id,[
          'name'=>$request->name,
          'description'=>$request->description,
          'tags'=>$request->tags
        ]);
        $this->activityContract->create([
          'entity_id'=>$album->id,
          'entity_type'=>'Gallery Album',
          'activity'=>'Album with name '.$album->name.' updated',
          'link'=>route('albums.index'),
          'type'=>'blue'
        ]);
        DB::commit();
        return redirect()
          ->route('albums.index')
          ->with('success','Album updated successfully.');
      } catch (\Exception $e){
        DB::rollBack();
        return redirect()
          ->back()
          ->withInput()
          ->with('warning','Error: '.$e->getCode());
      }
    }

    public function addImages(Request $request,$id)
    {
      if(!$request->ajax()){
        abort(404);
      }
      $gallery = $this->albumContract->find(decrypt($id));
      foreach($request->allFiles() as $file){
        $filenamewithext = $file->getClientOriginalName();
        $path = $file->storeAs('/gallery/'.$gallery->album_code,$filenamewithext,['disk'=>'public']);
        $gallery->images()->save( new AlbumImage([
          'image'=>$filenamewithext
        ]));
      }

      return response()->json(['message'=>'Image uploaded successfully'],200);
    }

    public function deleteImage(Request $request, $id)
    {

      if(!$request->ajax()){
        abort(404);
      }
      try{
        $album = $this->albumContract->find(decrypt($id));
        $image = $this->imageContract->chainWhere('album_id',$album->id)->where('image',$request->filename)->first();
        $image->delete();
        Storage::disk('public')->delete('/gallery/'.$album->album_code.'/'.$request->filename);

        return response()->json(['message'=>'Image removed'],200);
      } catch (\Exception $e){
        return response()->json(['message'=>'Error: '.$e->getCode()],500);
      }

    }


    public function destroy($id)
    {
      $album = $this->albumContract->find(decrypt($id));
      try{
        DB::beginTransaction();
        $album = $this->albumContract->delete($album->id);
        $this->activityContract->create([
          'entity_id'=>$album->id,
          'entity_type'=>'Gallery Album',
          'activity'=>'Album with name '.$album->name.' deleted',
          'link'=>route('albums.index'),
          'type'=>'red'
        ]);
        DB::commit();
        return redirect()
          ->route('albums.index')
          ->with('success','Album deleted successfully.');
      } catch (\Exception $e){
        DB::rollBack();
        return redirect()
          ->back()
          ->withInput()
          ->with('warning','Error: '.$e->getCode());
      }
    }


  }
