$(document).ready(function() {

	// поля картинок галереи
    var max = 10;
    var min = 1;
    $("#del").attr("disabled", true);
    $("#add").click(function(){
        var total = $("input[name='galleryimg[]']").length;
        if(total < max){
            $("#btnimg").append('<div><input class="btn btn-sm btn-info" type="file" data-bfi-disabled name="galleryimg[]" /></div>');
            if(max == total + 1){
                $("#add").attr("disabled", true);
            }
            $("#del").removeAttr("disabled");
        }
    });
    $("#del").click(function(){
        var total = $("input[name='galleryimg[]']").length;
        if(total > min){
           $("#btnimg div:last-child").remove();
           if(min == total - 1){
                $("#del").attr("disabled", true);
           }
           $("#add").removeAttr("disabled");
        }
    });
    // поля картинок галереи

	// удаление картинок
    $("#prodform").on("click", ".slideimg" ,function(){
        var res = confirm("Подтвердите удаление");
        if(!res) return false;
        
        var img = $(this).attr("alt"); // имя картинки
        var id = $(this).attr("attr-id"); // ID товара
        var loop = $(this).attr("attr-loop"); // Loop iteration ID
        
        $.ajax({
            dataType: "json",
            url: $(this).attr('attr-route'),
            type: "POST",
            data: {img: img, id: id},
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res){
                $(".slide_" + loop).hide(500);
                $(".results").empty().fadeIn(500).html(res).delay(2000).fadeOut(500);
            },
            error: function(){
                alert("Error");
            }
        });
    });
    // удаление картинок
    // DatePicker
    $( "#datepicker" ).datepicker();
    // Dependenet Select Boxes
    $('.filterSelect').filterSelect();

    // $("#myDropdown").prop("selectedIndex", -1);

    //  $("#cat-treeview ul").treeview({
    //     animated: "normal",
    //     persist: "location",
    //     collapsed: true,
    //     unique: true,
    // });

    // $("#cat-treeview-2 ul").treeview({
    //     animated: "normal",
    //     persist: "location",
    //     collapsed: true,
    //     unique: true,
    // });

    // $("#comments-treeview ul").treeview({
    //     animated: "normal",
    //     persist: "location",
    //     collapsed: true,
    //     unique: true,
    // });

    // $('#collapseOne').on('show.bs.collapse', function(){
    //     $('input[name=type]#r11').attr('checked', true);
    // });
    // $('#collapseOne').on('hide.bs.collapse', function(){
    //     $('input[name=type]#r11').attr('checked', false);
    // });

    // $('#collapseTwo').on('show.bs.collapse', function(){
    //     $('input[name=type]#r12').attr('checked', true);
    // });
    // $('#collapseTwo').on('hide.bs.collapse', function(){
    //     $('input[name=type]#r12').attr('checked', false);
    // });
    // $('#collapseThree').on('show.bs.collapse', function(){
    //     $('input[name=type]#r13').attr('checked', true);
    // });
    // $('#collapseThree').on('hide.bs.collapse', function(){
    //     $('input[name=type]#r13').attr('checked', false);
    // });

  // show/hide symbols in password type input field
  $(".showpassword").each(function(index,input) {
        var $input = $(input);
        $('<label class="showpasswordlabel"/>').append(
            $("<input type='checkbox' class='showpasswordcheckbox' />").click(function() {
                var change = $(this).is(":checked") ? "text" : "password";
                var rep = $("<input type='" + change + "' />")
                    .attr("id", $input.attr("id"))
                    .attr("name", $input.attr("name"))
                    .attr('class', $input.attr('class'))
                    .attr('style', $input.attr('style'))
                    .attr('placeholder', $input.attr('placeholder'))
                    .val($input.val())
                    .insertBefore($input);
                $input.remove();
                $input = rep;
             })
        ).append($("<span/>").text(" Показать")).insertAfter($input);
    });
       


});