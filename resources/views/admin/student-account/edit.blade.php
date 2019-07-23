@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-6">
		<h1>Student Account Record</h1>
	</div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs" id="myTab-6" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" href="#tab-1" data-toggle="tab" role="tab" aria-controls="tab-1" aria-selected="true">Account Details</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tab-2" data-toggle="tab" role="tab" aria-controls="tab-2" aria-selected="false">CLASS HISTORY</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content" id="student-account-details-tab">

					<div id="tab-1" class="row tab-pane fade show active" role="tabpanel" aria-labelledby="tab-1">
						<student-account-details :accounts="{{ $accounts }}" :student="{{ $student }}" :account-info="{{ json_encode($accountInfo) }}" :current-year="{{ $currentYear }}"></student-account-details>
					</div>

					<div id="tab-2" class="row tab-pane fade" role="tabpanel" aria-labelledby="tab-2">
						<student-account-class-list :class-schedules="{{ $classSchedules }}"></student-account-class-list>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
		<footer>

		</footer>
	</div>
</div>
@endsection
