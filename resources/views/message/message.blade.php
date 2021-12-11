
<div class="row">
    @if (Session::has('success'))
       <div class="col-md-12 alert alert-success"><h5 class="text-center text-white">{{ Session::get('success') }}</h5></div>
    @endif
    @if (Session::has('error'))
    <div class="col-md-12 alert alert-danger"><h5 class="text-center text-white">{{ Session::get('error') }}</h5></div>
    @endif
    @if (Session::has('warnning'))
    <div class="col-md-12 alert alert-warnning"><h5 class="text-center text-white">{{ Session::get('warnning') }}</h5></div>

    @endif
    @if (Session::has('info'))
    <div class="col-md-12 alert alert-info"><h5 class="text-center text-white">{{ Session::get('info') }}</h5></div>
       
    @endif
</div>
