<div class="col-sm-6 col-xl-3">
    <div class="card">
        <div class="card-body yeti-card">
            <div class="media">
                <div class="media-body">
                    <h5 class="font-size-14">Users</h5>
                </div>
                <div class="avatar-xs">
                    <span class="avatar-title rounded-circle bg-primary">
                        <i class="dripicons-tags"></i>
                    </span>
                </div>
            </div>
            <h4 class="m-0 align-self-center new-user"></h4>
            <p class="mb-0 mt-3 text-muted user-trend">

            </p>
        </div>
    </div>
</div>
<script>
    $.ajax({
        method: 'get',
        url: '{{ route('user.card.data') }}',
        success: function(response){
            $('.new-user').html(JSON.parse(response).users+' new users');
            $('.user-trend').html(JSON.parse(response).trend);
        },
        error: function () {
            $('.user-card').html('Couldn\'t load data.')
        }
    })
</script>
