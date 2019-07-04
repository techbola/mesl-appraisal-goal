<!-- Finance Modal -->
<div class="modal fade" id="financeModal" tabindex="-1" role="dialog" aria-labelledby="financeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="financeModalLabel">Update Item</h5>
			</div>

			<form action="{{ route('updateFinanceAppraisal') }}" method="post">
				@csrf
				<div class="modal-body">
					<table class="table">
						<thead>
						<tr>
							<th scope="col" class="text-center text-white bg-primary">Objectives</th>
							<th scope="col" class="text-center text-white bg-primary">KPIs</th>
							<th scope="col" class="text-center text-white bg-primary">Target</th>
							<th scope="col" class="text-center text-white bg-primary">Constraints</th>
						</tr>
						</thead>
						<tbody>

						<tr>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="financial_objective" value="" id="financeAppraisalObjective">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="financial_kpi" value="" id="financeAppraisalKpi">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="financial_target" value="" id="financeAppraisalTargets">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="financial_constraint" value="" id="financeAppraisalConstraint">
								</div>
							</td>
						</tr>

						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="financeAppraisalID" value="" id="financeAppraisalID">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- Customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="customerModalLabel">Update Item</h5>
			</div>

			<form action="{{ route('updateCustomerAppraisal') }}" method="post">
				@csrf
				<div class="modal-body">
					<table class="table">
						<thead>
						<tr>
							<th scope="col" class="text-center text-white bg-primary">Objectives</th>
							<th scope="col" class="text-center text-white bg-primary">KPIs</th>
							<th scope="col" class="text-center text-white bg-primary">Target</th>
							<th scope="col" class="text-center text-white bg-primary">Constraints</th>
						</tr>
						</thead>
						<tbody>

						<tr>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="stakeholders_objective" value="" id="customerAppraisalObjective">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="stakeholders_kpi" value="" id="customerAppraisalKpi">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="stakeholders_target" value="" id="customerAppraisalTargets">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="stakeholders_constraint" value="" id="customerAppraisalConstraint">
								</div>
							</td>
						</tr>

						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="customerAppraisalID" value="" id="customerAppraisalID">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- Internal Modal -->
<div class="modal fade" id="internalModal" tabindex="-1" role="dialog" aria-labelledby="internalModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="internalModalLabel">Update Item</h5>
			</div>

			<form action="{{ route('updateInternalAppraisal') }}" method="post">
				@csrf
				<div class="modal-body">
					<table class="table">
						<thead>
						<tr>
							<th scope="col" class="text-center text-white bg-primary">Objectives</th>
							<th scope="col" class="text-center text-white bg-primary">KPIs</th>
							<th scope="col" class="text-center text-white bg-primary">Target</th>
							<th scope="col" class="text-center text-white bg-primary">Constraints</th>
						</tr>
						</thead>
						<tbody>

						<tr>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="internal_process_objective" value="" id="internalAppraisalObjective">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="internal_process_kpi" value="" id="internalAppraisalKpi">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="internal_process_target" value="" id="internalAppraisalTargets">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="internal_process_constraint" value="" id="internalAppraisalConstraint">
								</div>
							</td>
						</tr>

						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="internalAppraisalID" value="" id="internalAppraisalID">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- Learning Modal -->
<div class="modal fade" id="learningModal" tabindex="-1" role="dialog" aria-labelledby="learningModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="learningModalLabel">Update Item</h5>
			</div>

			<form action="{{ route('updateLearningAppraisal') }}" method="post">
				@csrf
					<div class="modal-body">
					<table class="table">
						<thead>
						<tr>
							<th scope="col" class="text-center text-white bg-primary">Objectives</th>
							<th scope="col" class="text-center text-white bg-primary">KPIs</th>
							<th scope="col" class="text-center text-white bg-primary">Target</th>
							<th scope="col" class="text-center text-white bg-primary">Constraints</th>
						</tr>
						</thead>
						<tbody>

						<tr>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="learning_objective" value="" id="learningAppraisalObjective">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="learning_kpi" value="" id="learningAppraisalKpi">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="learning_target" value="" id="learningAppraisalTargets">
								</div>
							</td>
							<td>
								<div class="form-group form-group-default">
									<input type="text" class="form-control" name="learning_constraint" value="" id="learningAppraisalConstraint">
								</div>
							</td>
						</tr>

						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="learningAppraisalID" value="" id="learningAppraisalID">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>

		</div>
	</div>
</div>

{{-- Comment Modal --}}
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="commentModalLabel">Update Comment</h5>
			</div>

			<form action="{{ route('updateAppraisalComment') }}" method="post">

				@csrf

				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="appraiseeComment" id="appraiseeComment">
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="commentID" id="commentAppraisalID">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>

			</form>

		</div>
	</div>
</div>

{{-- Signature Modal --}}
<div class="modal fade" id="signatureModal" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="signatureModalLabel">Update Signature</h5>
			</div>

			<form action="{{ route('updateAppraisalSign') }}" method="post" enctype="multipart/form-data">

				@csrf

				<div class="modal-body">
					<div class="form-group">
						<input type="file" class="form-control" name="appraiseeSign" id="appraiseeSign">
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="signatureID" id="signatureID">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>

			</form>

		</div>
	</div>
</div>