@extends('layouts.app')

@section('styling')
<link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fonts/line-awesome/css/line-awesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap/mdb.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/hamburgers/hamburgers.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/jvmaps/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">
<style>
	.invalid-feedback {
		display: block;
	}
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<h1>Enroll Student</h1>
	</div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 pb-5">
						<h2>Enrollment Details</h2>
						<form class="needs-validation" method="POST" action="{{route('enrollment.store')}}" novalidate>
							@csrf
							<div class="form-row">
								<div class="col-md-3 mb-2">
									<label for="validationCustom01">Student Name</label>
									<div class="form-group">
										<select class="select2Element form-control" id="student_name_id" name="student_name_id" onchange="studentID(this.value)">
											<option value="" selected disabled>Select Student</option>
											@foreach($students as $student)
											<option value="{!! $student->id !!}">{!! $student->last_name !!}, {!! $student->first_name !!}</option>
											@endforeach
										</select>
									</div>
									@if ($errors->has('student_id'))
										<div class="invalid-feedback">You must select a student</div>
									@endif
								</div>
								<div class="col-md-2 mb-2">
									<label for="validationCustom02">Student ID</label>
									<div class="form-group">
										<input type="text" class="form-control" id="student_id" name="student_id" readonly>
									</div>
								</div>
								<div class="col-md-1 mb-2">
									<label for="validationCustom02">Credits</label>
									<input type="number" class="form-control" id="credits" name="credits">
									@if ($errors->has('credits'))
										<div class="invalid-feedback">{{ $errors->first('credits') }}</div>
									@endif
								</div>
								<div class="col-md-2 mb-2">
									<label for="validationCustom02">Credit Type</label>
									<div class="form-group">
										<select class="form-control" id="class_type" name="class_type">
											@foreach($classtypes as $classtype)
											<option value="{!! $classtype->id !!}">{!! $classtype->name !!}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2 mb-2">
									<label for="validationCustom02">Amount Paid</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">₱</span>
										</div>
										<input type="text" class="form-control" id="amount_paid" name="amount_paid">	
									</div>
									@if ($errors->has('amount_paid'))
										<div class="invalid-feedback">{{ $errors->first('amount_paid') }}</div>
									@endif
								</div>
								<div class="col-md-2 mb-2">
									<label for="validationCustom02">Payment Status</label>
									<div class="form-group">
										<select class="form-control" id="payment_status" name="payment_status">
											<option value="Fully Paid">Fully Paid</option>
											<option value="Partial">Partial</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-3 mb-3">
									<label for="validationCustom03">Total Cost/Balance</label>
									<div class="form-row">
										<div class="col-md-4">
											<button type="button" class="btn btn-primary waves-effect waves-light" onclick="calculate()"><i class="ml-2 batch-icon batch-icon-refresh" style="margin: 0 !important;"></i></button>
										</div>
										<div class="col-md-8">
											<div id="calc_formula"></div>
										</div>
											
										
									</div>
									<div class="form-row">
										<div class="col-md-12 mt-3 input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Total</span>
											</div>
											<input class="form-control" type="text" id="calc_total" value="" readonly>	
										</div>
										<div class="col-md-12 mt-3 input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Balance</span>
											</div>
											<input class="form-control" type="text" id="calc_balance" value="" readonly>	
										</div>
									</div>
									
								</div>
								<div class="col-md-9 mb-3">
									<label for="validationCustom03">Remarks</label>
									<textarea class="form-control" rows="4" id="remarks" name="remarks" style="min-height: 12.3rem;"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary pull-right">Add Enrollment <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
								</div>
							</div>
						</form>

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

@section('scripts')
{{-- <script src="{{ asset('assets/js/jquery/jquery-3.1.1.min.js') }}" defer></script> --}}
<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}" defer></script>
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('assets/js/bootstrap/mdb.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/velocity/velocity.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/velocity/velocity.ui.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}" defer></script>
<script src="{{ asset('assets/js/misc/ie10-viewport-bug-workaround.js') }}" defer></script>
<script src="{{ asset('assets/js/misc/holder.min.js') }}" defer></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
	function calculate() {
		var total = 0;
		var rates = {!! $classtypes !!};
		var salectedRate = 0;
		var balance = 0;
			
		for(var x = 0; x < rates.length; x++) {
			if(rates[x].id == $('#class_type').val()) {
				salectedRate = rates[x].rate;
				total = $('#credits').val() * salectedRate;
				balance = total - $('#amount_paid').val();
			}
		}

		$('#calc_total').val(total);
		$('#calc_balance').val(balance);
		$('#calc_formula').html('Formula:<br>' + $('#credits').val() + '(Credits) * '+ salectedRate +'('+ $('#class_type  option:selected').text() +')');
	}

	function studentID(id) {

		var student = {!! $students !!};
		
		$('#student_id').val(student[parseInt(id)-1].id_num);
	}

	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
	    $('.select2Element').select2();
	});
</script>
@endsection