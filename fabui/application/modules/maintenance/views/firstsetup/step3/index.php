<div class="step-pane" id="step3">

	<div class="row margin-top-10 choice">
		
		<div class="col-sm-12">
			<h1 class="text-center text-primary"><span class="badge bg-color-blue txt-color-white"  style="vertical-align: middle;">3</span> <strong>Probe Calibration</strong></h1>
		</div>

		<div class="col-sm-12">
			<div class="well">
				<!--<h3 class="text-center text-primary">Assisted calibration</h3>-->
				<h2 class="text-center">The probe lenght will be now calculated in order to correct the nozzle height during prints</h2>
				<h2 class="text-center"><a data-action='normal' href="javascript:void(0);" class="btn btn-default btn-primary btn-circle btn-lg choice-button"><i class="fa fa-chevron-down"></i></a></h2>
			</div>
		</div>
		<div class="col-sm-6 hidden">
			<div class="well">
				<h3 class="text-center text-primary">Fine calibration</h3>
				<h2 class="text-center"><a data-action='fast' href="javascript:void(0);" class="btn btn-default btn-primary btn-circle btn-lg choice-button"><i class="fa fa-chevron-down"></i></a></h2>
			</div>
		</div>
		<div class="col-sm-12">
			<p class="text-center">
				<a href="javascript:void(0);" class="btn btn-sm btn-primary btn-prev "><i class="fa fa-arrow-left"></i> Prev</a>
			</p>
		</div>
	</div>

	<div class="row margin-top-10 re-choice" style="display: none;">
		<div class="col-sm-12">
			<h2 class="text-center"><a data-action='unload' href="javascript:void(0);" class="btn btn-primary btn-default btn-circle btn-lg re-choice-button"><i class="fa fa-chevron-up"></i></a></h2>
		</div>
	</div>

	<div class="row margin-top-10 calibration" id="row-normal-1" style="display:none;">
		<div class="col-sm-12">
			<div class="well">
				<div class="row">

					<div class="col-sm-6 text-center">
						<img style="max-width: 50%; display: inline;" class="img-responsive" src="<?php echo module_url('maintenance').'assets/img/probecalibration/nozzle.png' ?>" />
					</div>

					<div class="col-sm-6 text-center">
						<h2>Make sure nozzle is clean and then press OK to continue</h2>
						<a href="javascript:void(0);" id="probe-calibration-prepare" class="btn btn-primary btn-default btn-lg">Ok</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row margin-top-10 calibration" id="row-normal-2" style="display:none;">
		<div class="col-sm-12">
			<div class="well">
				<div class="row">
					<div class="col-sm-6 text-center">
						<img style="max-width: 50%; display: inline;" class="img-responsive" src="<?php echo module_url('maintenance').'assets/img/probecalibration/head_calibration.png' ?>" />
					</div>
					<div class="col-sm-6">
						<div class="row margin-bottom-20">
							<div class="col-sm-12">
								<h4 class="text-center"> Using the buttons below, raise the bed until a standard piece of copy paper (80 mg) can barely move between the nozzle and the bed.
								<br>
								<i class="fa fa-warning"></i> Caution the nozzle is hot!
								<br>
								<br>
								When done press Calibrate to finish </h4>
							</div>
						</div>
						<hr>
						<div class="row">

							<div class="smart-form">
								<fieldset style="background: none; !important">
									<div class="row">
										<section class="col col-3 text-center">
											<label><strong>Z</strong></label>
										</section>
										<section class="col col-6 text-center">
											<label><strong>Step (mm)</strong></label>
										</section>
										<section class="col col-3 text-center">
											<label><strong>Z</strong></label>
										</section>
									</div>
									<div class="row">
										<section class="col col-3">
											<button data-action="+" type="button" class="btn  btn-default btn-primary btn-sm btn-block z-action">
												<i class="fa fa-arrow-down"></i>
											</button>
										</section>
										<section class="col col-6">
											<label class="input">
												<input id="z-value" type="text" style="text-align: center;" value="0.1">
											</label>
										</section>
										<section class="col col-3">
											<button data-action="-" type="button" class="btn btn-primary  btn-default btn-sm btn-block z-action">
												<i class="fa fa-arrow-up"></i>
											</button>
										</section>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="row text-align-center">
							<a href="javascript:void(0);" id="probe-calibration-calibrate" class="btn btn-primary btn-default btn-lg">Calibrate</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="row margin-top-10 calibration" id="row-normal-3" style="display:none;">
		<div class="col-sm-12">

			<div class="row">
				<div class="col-sm-3">
					<h3 class="text-primary">Calibration result</h3>
				</div>
			</div>
			<div class="row margin-top-10">
				<div class="col-sm-12">
					<pre id="calibrate-trace"></pre>
				</div>
			</div>
			
			<div class="row margin-top-10">
				
				<div class="col-sm-12">
					<p class="text-center">
						<a href="javascript:void(0);" class="btn btn-sm btn-primary btn-prev "><i class="fa fa-arrow-left"></i> Prev</a>
						<a href="javascript:void(0);" class="btn btn-primary btn-warning calibrate-again" style="margin-left: 5px;"> Calibrate again</a>
						<a href="javascript:void(0);" class="btn btn-sm btn-success btn-next" style="margin-left: 5px;"> Next <i class="fa fa-arrow-right"></i></a>
					</p>
				</div>
				
			</div>
			
		</div>
	</div>

	<div class="row margin-top-10 calibration" id="row-fast-1" style="display:none;">

		<div class="col-sm-12">
			<div class="well">
				<div class="row">
					<div class="col-sm-6">
						<h4 class="text-center"> Fine Probe lenght Calibration
						<br>
						If the print first layer is too high or too close to the bed, use this function to finely calibrate the distance from the nozzle and the bed during 3D-prints. Usually 0.05mm increments are enough to make a difference. </h4>
					</div>
					<div class="col-sm-6">

						<div class="row">
							<div class="smart-form">
								<fieldset style="background: none; !important">
									<div class="row">
										<section class="col col-3 text-center">
											<label><strong>Closer</strong></label>
										</section>
										<section class="col col-6 text-center">
											<label><strong>Override length (<span id="probe-lenght"></span> mm)</strong></label>
										</section>
										<section class="col col-3 text-center">
											<label><strong>Further</strong></label>
										</section>
									</div>
									<div class="row">
										<section class="col col-3">
											<button data-action="-" type="button" class="btn btn-primary btn-default btn-sm btn-block change-over">
												<i class="fa fa-minus"></i>
											</button>
										</section>
										<section class="col col-6">
											<label class="input">
												<input max="2" min="-2" id="over" type="text" style="text-align: center;" readonly="true" value="0">
											</label>
										</section>
										<section class="col col-3">
											<button data-action="+" type="button" class="btn btn-primary btn-default btn-sm btn-block change-over">
												<i class="fa fa-plus"></i>
											</button>
										</section>
									</div>
								</fieldset>
							</div>
						</div>

						<div class="row text-align-center">
							<button type="button" id="probe-calibration-save" class="btn btn-primary btn-default btn-lg">
								Save
							</button>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row margin-top-10 calibration" id="row-fast-2" style="display:none;">

		<div class="col-sm-12">

			<div class="row">
				<div class="col-sm-2">
					<h3 class="text-primary">Calibration result</h3>
				</div>
				
			</div>
			<div class="row ">
				<div class="col-sm-12">
					<pre id="over-calibrate-trace" style="height: 150px;"></pre>
				</div>
			</div>
			
			<div class="row margin-top-10">
				
				<div class="col-sm-12">
					<p class="text-center">
						<a href="javascript:void(0);" class="btn btn-sm btn-primary btn-prev "><i class="fa fa-arrow-left"></i> Prev</a>
						<a href="javascript:void(0);" class="btn btn-primary btn-warning calibrate-again" style="margin-left: 5px;"> Calibrate again</a>
						<a href="javascript:void(0);" class="btn btn-sm btn-success btn-next" style="margin-left: 5px;"> Next <i class="fa fa-arrow-right"></i></a>
					</p>
				</div>
				
			</div>
		</div>

	</div>

</div>