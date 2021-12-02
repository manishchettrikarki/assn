<audio id="warn-sound">
    <source src="{{ asset('audio/warning.mp3') }}" muted type="audio/mpeg">
</audio>
<audio id="suc-sound">
    <source src="{{ asset('audio/success.mp3') }}" muted type="audio/mpeg">
</audio>
</div>
@include('back.partials.right-sidebar')
@yield('script')
@if(session('warning'))
    <script>
        $('audio#warn-sound').get(0).play();
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'error',
            title: '{{ session('warning') }}'
        })
    </script>
@endif
@if(session('success'))
    <script>
        $('audio#suc-sound').get(0).play();
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        })
    </script>
    @endif
</body>
</html>
