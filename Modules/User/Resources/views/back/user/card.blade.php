<div class="col-sm-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="media">
                <div class="media-body">
                    <h5 class="font-size-14">{{ $user->name }}</h5>
                </div>
                <div class="avatar-xs">
                    <span class="avatar-title rounded-circle bg-primary">
                        <i class="ti-user"></i>
                    </span>
                </div>
            </div>
            <h6 class="m-0 align-self-center">{{ $user->email }}</h6>
            <p class="mb-0 mt-3 text-muted">
                <span class="text-success"><i class="mdi mdi mdi-phone-in-talk-outline mr-1"></i>
                {{ ((bool)$user->phone)?$user->phone:'Not available' }}
                </span>
            </p>
            <p class="mb-0 mt-3 text-muted">

                    @if($user->is_active)
                        <span class="text-success">
                            Active
                        </span>
                    @else
                    <span class="text-danger">
                        Inactive
                    </span>
                    @endif

            </p>
        </div>
    </div>
</div>
<script>
    $.ajax({

    })
</script>
