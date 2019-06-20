$(document).on("click", ".editFinanceDialog", function () {

    let appraisalId = $(this).data('id');
    let appraisalObjective = $(this).data('objective');
    let appraisalKpi = $(this).data('kpi');
    let appraisalTargets = $(this).data('targets');
    let appraisalConstraint = $(this).data('constraint');

    $("#financeAppraisalID").val( appraisalId );
    $("#financeAppraisalObjective").val( appraisalObjective );
    $("#financeAppraisalKpi").val( appraisalKpi );
    $("#financeAppraisalTargets").val( appraisalTargets );
    $("#financeAppraisalConstraint").val( appraisalConstraint );

});

$(document).on("click", ".editCustomerDialog", function () {

    let appraisalId = $(this).data('id');
    let appraisalObjective = $(this).data('objective');
    let appraisalKpi = $(this).data('kpi');
    let appraisalTargets = $(this).data('targets');
    let appraisalConstraint = $(this).data('constraint');

    $("#customerAppraisalID").val( appraisalId );
    $("#customerAppraisalObjective").val( appraisalObjective );
    $("#customerAppraisalKpi").val( appraisalKpi );
    $("#customerAppraisalTargets").val( appraisalTargets );
    $("#customerAppraisalConstraint").val( appraisalConstraint );

});

$(document).on("click", ".editInternalDialog", function () {

    let appraisalId = $(this).data('id');
    let appraisalObjective = $(this).data('objective');
    let appraisalKpi = $(this).data('kpi');
    let appraisalTargets = $(this).data('targets');
    let appraisalConstraint = $(this).data('constraint');

    $("#internalAppraisalID").val( appraisalId );
    $("#internalAppraisalObjective").val( appraisalObjective );
    $("#internalAppraisalKpi").val( appraisalKpi );
    $("#internalAppraisalTargets").val( appraisalTargets );
    $("#internalAppraisalConstraint").val( appraisalConstraint );

});

$(document).on("click", ".editLearningDialog", function () {

    let appraisalId = $(this).data('id');
    let appraisalObjective = $(this).data('objective');
    let appraisalKpi = $(this).data('kpi');
    let appraisalTargets = $(this).data('targets');
    let appraisalConstraint = $(this).data('constraint');

    $("#learningAppraisalID").val( appraisalId );
    $("#learningAppraisalObjective").val( appraisalObjective );
    $("#learningAppraisalKpi").val( appraisalKpi );
    $("#learningAppraisalTargets").val( appraisalTargets );
    $("#learningAppraisalConstraint").val( appraisalConstraint );

});

$(document).on("click", ".editCommentDialog", function () {

    let commentId = $(this).data('id');
    let appraiseeComment = $(this).data('comment');

    $("#commentAppraisalID").val( commentId );
    $("#appraiseeComment").val( appraiseeComment );

});

$(document).on("click", ".editSignDialog", function () {

    let signatureID = $(this).data('id');

    $("#signatureID").val( signatureID );

});