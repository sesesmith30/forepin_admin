@if(session('status'))
	<div class="alert alert-info alert-has-icon alert-dismissible show fade">
	    <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
	    <div class="alert-body">
	        <button class="close" data-dismiss="alert">
	            <span>&times;</span>
	        </button>
	        <div class="alert-title">Success</div>
	        {{ session('status') }}
	    </div>
	</div>
@endif

@if(session('error'))
	<div class="alert alert-info alert-has-icon alert-dismissible show fade">
	    <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
	    <div class="alert-body">
	        <button class="close" data-dismiss="alert">
	            <span>&times;</span>
	        </button>
	        <div class="alert-title">Error</div>
	        {{ session('error') }}
	    </div>
	</div>
@endif



@if( sizeof($errors) > 0 )
	<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
	    <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
	    <div class="alert-body">
	        <button class="close" data-dismiss="alert">
	            <span>&times;</span>
	        </button>
	        <div class="alert-title">Error</div>
	        {{ $errors->first() }}
	    </div>
	</div>
@endif