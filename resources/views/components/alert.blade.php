<style>
    .custom-alert {
        position: absolute !important;
        z-index: 999;
        left: 40%;
        top: 0;
    }
    @media (max-width: 768px){
        .custom-alert{
            left: 10%;
        }
    }
</style>
<!-- <div class="custom-alert alert alert-success alert-dismissible px-5 py-2 mx-4 w-25 " role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <div class="d-flex align-items-center justify-content-evenly">
        <span><i class="fa fa-check mr-3"></i></span>
        <span>
            Transaction Created successfully
        </span>
    </div>

</div> -->
@if (session()->has('message'))
<div class="custom-alert alert alert-success alert-dismissible px-5 py-2 mx-4 col-lg-4 col-md-4" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <span><i class="fa fa-check mr-3"></i></span>
    <span>

        {{session('message')}}
    </span>
</div>
@elseif (session()->has('error'))
<div class="alert alert-danger alert-dismissible px-5 py-2 mx-4 fade in" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <p>
        <i class="close mr-3"></i>
        {{session('error')}}
    </p>
</div>
@endif