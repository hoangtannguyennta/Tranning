@if(session()->has('errors'))
    <script >
    $.toast({
        heading: 'Errors',
        text:  'Vui lòng nhập ít số lượng hiện có',
        bgColor: '#FF1356',
        position: 'mid-center',
        stack: false
    })
    </script>
@endif
