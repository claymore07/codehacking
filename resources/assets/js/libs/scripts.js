/**
 * Created by edwin on 11/7/15.
 */

$(document).ready(function(){

    $('#selectAllBoxes').click(function(event){

        if(this.checked) {

            $('.checkBoxes').each(function(){

                this.checked = true;

            });

        } else {


            $('.checkBoxes').each(function(){

                this.checked = false;

            });


        }

    });





    /**************** User Profile **********************/



    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    //$('button').click(function(e) {
    //    e.preventDefault();
    //    alert("This is a demo.\n :-)");
    //});

    //user delete link action
    function reset () {
        $("#toggleCSS").attr("href", "css/libs.css");

        alertify.set({
            labels : {
                ok     : "تایید",
                cancel : "لغو"
            },
            delay : 5000,
            buttonReverse : false,
            buttonFocus   : "ok"
        });
    }
    $(function () {
        $('.data-delete').on('click', function (e) {
            reset();
            alertify.set({ delay: 15000 });
            var action = $('#form-delete-' + $(this).data('form'));
            e.preventDefault();
            alertify.confirm("آیا از حذف اطلاعات مربوطه مطمئن هستید؟", function (e) {

                if (e) {

                    console.log(action);
                   action.submit();
                }else{

                    alertify.error("عملیات توسط کاربر لغو شد!");
                }
            });


        });
    });



});