function displayMsg() {

    $(document).ready(function() {

        $("input[type='checkbox']").change(function() {

            var cbChecked = new Array();

            $("input[type='checkbox']:checked").each(function() {
                cbChecked[cbChecked.length] = this.value;
            });

            document.getElementById('appraisalIDs').value = cbChecked;
            // console.log(cbChecked)

        });

    });

}

function displayMsg1() {

    $(document).ready(function() {

        $("input[type='checkbox']").change(function() {

            var cbChecked = new Array();

            $("input[type='checkbox']:checked").each(function() {
                cbChecked[cbChecked.length] = this.value;
            });

            document.getElementById('appraisalIDs1').value = cbChecked;
            // console.log(cbChecked)

        });

    });

}

function displayMsg2() {

    $(document).ready(function() {

        $("input[type='checkbox']").change(function() {

            var cbChecked = new Array();

            $("input[type='checkbox']:checked").each(function() {
                cbChecked[cbChecked.length] = this.value;
            });

            document.getElementById('appraisalIDs2').value = cbChecked;
            // console.log(cbChecked)

        });

    });

}

function displayMsg3() {

    $(document).ready(function() {

        $("input[type='checkbox']").change(function() {

            var cbChecked = new Array();

            $("input[type='checkbox']:checked").each(function() {
                cbChecked[cbChecked.length] = this.value;
            });

            document.getElementById('appraisalIDs3').value = cbChecked;
            // console.log(cbChecked)

        });

    });

}