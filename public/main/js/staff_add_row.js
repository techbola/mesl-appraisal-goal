$(document).ready(function () {

    var i = 1;
    var j = 1;
    var k = 1;
    var l = 1;

    $('#addFinancialRow').click(function (e) {

        e.preventDefault();

        i++;

        $('#financial_dynamic_field').append('<tr id="financial_row'+i+'">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="financial_objective[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="financial_kpi[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="financial_target[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="financial_constraint[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t  \t<button name="remove" id="'+i+'" style="color: red;font-size: 20px;" class="financial_btn_remove">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class="fa fa-minus-circle"></i>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t  \t</button>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>');

    });

    $(document).on('click', '.financial_btn_remove', function (e) {

        e.preventDefault();

        var button_id = $(this).attr("id");

        $("#financial_row"+button_id+"").remove();

    });

    $('#addStakeholderRow').click(function (e) {

        e.preventDefault();

        j++;

        $('#stakeholder_dynamic_field').append('<tr id="stakeholder_row'+j+'">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="stakeholders_objective[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="stakeholders_kpi[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="stakeholders_target[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="stakeholders_constraint[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t  \t<button name="remove" id="'+j+'" style="color: red;font-size: 20px;" class="stakeholder_btn_remove">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class="fa fa-minus-circle"></i>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t  \t</button>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>');

    });

    $(document).on('click', '.stakeholder_btn_remove', function (e) {

        e.preventDefault();

        var button_id = $(this).attr("id");

        $("#stakeholder_row"+button_id+"").remove();

    });

    $('#addInternalRow').click(function (e) {

        e.preventDefault();

        k++;

        $('#internal_dynamic_field').append('<tr id="internal_row'+k+'">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="internal_process_objective[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="internal_process_kpi[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="internal_process_target[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="internal_process_constraint[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t  \t<button name="remove" id="'+k+'" style="color: red;font-size: 20px;" class="internal_btn_remove">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class="fa fa-minus-circle"></i>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t  \t</button>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>');

    });

    $(document).on('click', '.internal_btn_remove', function (e) {

        e.preventDefault();

        var button_id = $(this).attr("id");

        $("#internal_row"+button_id+"").remove();

    });

    $('#addLearningRow').click(function (e) {

        e.preventDefault();

        l++;

        $('#learning_dynamic_field').append('<tr id="learning_row'+l+'">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="learning_objective[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="learning_kpi[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="learning_target[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="form-group form-group-default">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type="text" class="form-control" name="learning_constraint[]">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t  \t<button name="remove" id="'+l+'" style="color: red;font-size: 20px;" class="learning_btn_remove">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class="fa fa-minus-circle"></i>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t  \t</button>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</td>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t\t</tr>');

    });

    $(document).on('click', '.learning_btn_remove', function (e) {

        e.preventDefault();

        var button_id = $(this).attr("id");

        $("#learning_row"+button_id+"").remove();

    });

});