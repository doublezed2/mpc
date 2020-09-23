// Set Date format
Date.prototype.toShortFormat = function() {
  var day = this.getDate();
  var month = this.getMonth() + 1;
  var year = this.getFullYear();
  return "" + day + "-" + month + "-" + year;
}

// Calculate amount paid at Sell
$("#amount-paid").keyup(function(){
  var amountPaid = Number(parseFloat($("#amount-paid").val()).toFixed(2));
  var finalAmount = Number(parseFloat($("#final-bill").html()).toFixed(2));
  var amountReturn =  Number(parseFloat(amountPaid - finalAmount).toFixed(0)); 
  $("#amount-return").val(amountReturn);      
});

// Report mobile autocomplete
$(function() {
  $("#p-name-mobile").autocomplete({
    source: "read-products.php",
    select: function( event, ui ) {
      event.preventDefault();
      $('#p-name-mobile').val(ui.item.label);
    }
  });
});

// GR autocomplete
$(function() {
  $("#product-name-po").autocomplete({
    source: "read-products.php",
    select: function( event, ui ) {
      event.preventDefault();
      $('#product-name-po').val(ui.item.label);
      var str_arr1 = ui.item.value;
      var split_arr1 = str_arr1.split("|");
      $('#p-comp').val(split_arr1[0]);
      $('#p-type').val(split_arr1[1]);
      $('#packing').val(split_arr1[2]);
      $('#rp').val(split_arr1[3]);
      $('#tp').val(split_arr1[4]);
      $('#up').val(split_arr1[5]);
    }
  });
});

// Add purchase order autocomplete
$(function() {
  $(".product-name-po").autocomplete({
    source: "read-products.php",
    select: function( event, ui ) {
      event.preventDefault();
      $(this).val(ui.item.label);
      var str_arr1 = ui.item.value;
      var split_arr1 = str_arr1.split("|");
      var company_field = $(this).siblings('.company');
      var ptype_field = $(this).siblings('.ptype');
      var rp_field = $(this).closest('td').siblings().find('.rp');
      var tp_field = $(this).closest('td').siblings().find('.tp');
      var up_field = $(this).closest('td').siblings().find('.up');
      var packing_field = $(this).closest('td').siblings().find('.pck');
      
      if(split_arr1[1] == "medicine"){
        rp_field.prop('readonly', false);
        tp_field.prop('readonly', true);
      }
      else{
        tp_field.prop('readonly', false);
        rp_field.prop('readonly', true);
      }
      company_field.val(split_arr1[0]);
      ptype_field.val(split_arr1[1]);
      packing_field.val(split_arr1[2]);
      rp_field.val(split_arr1[3]);
      tp_field.val(split_arr1[4]);
      up_field.val(split_arr1[5]);
    }
  });
});

// Calculate RP at PO
$(".rp").keyup(function(){
  var p_type = $(this).closest('td').siblings().find('.ptype').val();
  var rp = $(this).val();
  var pck = $(this).closest('td').siblings().find('.pck').val();
  if(p_type == "medicine"){
    var tp = Number(parseFloat(rp - (rp * 0.15)).toFixed(2));
    $(this).closest('td').siblings().find('.tp').val(tp);
    $(this).closest('td').siblings().find('.up').val(parseFloat(rp/pck).toFixed(2));
  }
});

// Calculate TP at PO
$(".tp").keyup(function(){
  var p_type = $(this).closest('td').siblings().find('.ptype').val();
  var tp = parseFloat($(this).val());
  var pck = $(this).closest('td').siblings().find('.pck').val();
  if(p_type == "cosmetics"){
    var rp = Number(parseFloat( tp + (tp * 0.1)).toFixed(2));
    $(this).closest('td').siblings().find('.rp').val(rp);
    $(this).closest('td').siblings().find('.up').val(parseFloat(rp/pck).toFixed(2));
  }
});

// Return to company autocomplete
$(function() {
  $(".p-name-ret-comp").autocomplete({
    source: "read-stock-return.php",
    select: function( event, ui ) {
      event.preventDefault();
      $(this).val(ui.item.label);
      var str_arr1 = ui.item.value;
      var split_arr1 = str_arr1.split("|");
      var p_id = $(this).siblings('.p_id');
      var p_comp = $(this).closest('td').siblings().find('.company');
      var qty_field = $(this).closest('td').siblings().find('.qty');
      var exp_field = $(this).closest('td').siblings().find('.date-mask');
      var bp_field = $(this).closest('td').siblings().find('.bonus_p');
      var batch_field = $(this).closest('td').siblings().find('.batch');
      var rp_field = $(this).closest('td').siblings().find('.rp');
      var tp_field = $(this).closest('td').siblings().find('.tp');
      p_id.val(split_arr1[0]);
      qty_field.val(split_arr1[1]);
      exp_field.val(split_arr1[2]);
      bp_field.val(split_arr1[3]);
      batch_field.val(split_arr1[4]); 
      rp_field.val(split_arr1[5]);
      tp_field.val(split_arr1[6]);
      p_comp.val(split_arr1[7]);
    }
  });
});

// Sell autocomplete
$("#product-name-sell").autocomplete({
  source: "read-stock.php",
  select: function( event, ui ) {
    event.preventDefault();
    $('#product-name-sell').val(ui.item.label);
    var str_arr = ui.item.value;
    var split_arr = str_arr.split("|");
    $('#product-up').val(split_arr[0]);
    $('#discount_p').val(split_arr[1]);
    $('#product_id').val(split_arr[4]);
    if(split_arr[2]<1){
      $("#available-stock").removeClass("text-success");
      $("#available-stock").addClass("text-danger");
    }
    else{
      $("#available-stock").removeClass("text-danger");
      $("#available-stock").addClass("text-success");
    }
    $("#available-stock > span").html(split_arr[2]);
    
    $("#expiry-date > span").html(split_arr[3]);
    var cur_date = new Date();
    var p_expiry = new Date(split_arr[3]);
    if(p_expiry<=cur_date){
      $("#expiry-date").removeClass("text-success");
      $("#expiry-date").addClass("text-danger");
    }
    else{
      $("#expiry-date").removeClass("text-danger");
      $("#expiry-date").addClass("text-success");
    }
  }
});

// Remove item from sell table.
$(document).on('click','.remove-item-btn',function() {
  var thisRow = $(this).closest("tr");
  $(this).closest("tr").remove();
  var p_price = Number(parseFloat(thisRow[0]["cells"][4]["innerText"]).toFixed(2));
  var p_discount = Number(parseFloat(thisRow[0]["cells"][5]["innerText"]).toFixed(2));;
  var sub_total =Number($("#total-bill").val());
  //console.info(sub_total+"-"+p_price);
  var totalDiscount =Number($("#total-discount").val());
  sub_total = Number(parseFloat(sub_total - p_price).toFixed(2));
  totalDiscount = Number(parseFloat(totalDiscount-p_discount).toFixed(2));
  var finalBill = Number(parseFloat(sub_total - totalDiscount).toFixed(2));
  $("#total-bill").val(sub_total);
  $("#total-discount").val(totalDiscount);
  $("#totalBill-row").remove();
  $("#discount-row").remove();
  $("#finalBill-row").remove();

  $("#print-table").append('<tr id="totalBill-row"><td></td><td><strong>Sub-Total</strong></td><td></td><td></td><td>'+sub_total+'</td></tr>');
  $("#print-table").append('<tr id="discount-row"><td></td><td><strong>Discount</strong></td><td></td><td></td><td>'+totalDiscount+'</td></tr>');
  $("#print-table").append('<tr id="finalBill-row"><td></td><td><strong>Total</strong></td><td></td><td></td><td><strong><span id="final-bill">'+finalBill+'</span></strong></td></tr>');    
});

// Add item to sell table
$("#add-p-btn").click(function(){
  var p_up = $("#product-up").val();
  var p_quantity = $("#product-quantity").val();
  //console.info(p_up);
  var p_id = $("#product_id").val();
  if(p_quantity == 0 ){
    alert("Please add Quantity");
    $("#product-quantity").focus();
  }
  else if(p_up == '0'){
    alert("Incorrect Product");
    $("#product-name-sell").focus();
  }
  else{    
    
    var p_name = $("#product-name-sell").val();
    var p_up = $("#product-up").val();
    var subTotal = Number(parseFloat(p_up*p_quantity).toFixed(2));
    var discount_val = Number($("#discount_p").val())/100;
    var discount_amount = Number(parseFloat(subTotal*discount_val).toFixed(2));
    
    var totalBill =Number($("#total-bill").val());
    var totalDiscount =Number($("#total-discount").val());
    //console.info(totalDiscount);
    totalDiscount = Number(parseFloat(totalDiscount+discount_amount).toFixed(2));
    
    totalBill = Number(parseFloat(totalBill + subTotal).toFixed(2)) ;
    var finalBill = Number(parseFloat(totalBill - totalDiscount).toFixed(2)); 
    //console.info(totalBill);
    
    $("#total-bill").val(totalBill);
    $("#total-discount").val(totalDiscount);
    //console.info($("#total-discount").val());
    
    $("#print-table").append('<tr> <td class="no-print"><a class="remove-item-btn" href="#">X</a></td> <td>'+p_name+'</td><td>'+p_up+'</td><td>'+p_quantity+'</td><td>'+subTotal+'</td><td class="hide-all">'+discount_amount+'</td><td class="hide-all">'+p_id+'</td></tr>');
    $("#totalBill-row").remove();
    $("#discount-row").remove();
    $("#finalBill-row").remove();
    
    $("#print-table").append('<tr id="totalBill-row"><td class="no-print"></td><td><strong>Sub-Total</strong></td><td></td><td></td><td>'+totalBill+'</td></tr>');
    $("#print-table").append('<tr id="discount-row"><td class="no-print"></td><td><strong>Discount</strong></td><td></td><td></td><td>'+totalDiscount+'</td></tr>');
    $("#print-table").append('<tr id="finalBill-row"><td class="no-print"></td><td><strong>Total</strong></td><td></td><td></td><td><strong><span id="final-bill">'+finalBill+'</span></strong></td></tr>');
    

    $("#product-name-sell").val('');
    $("#product-quantity").val('1');
    $("#product-up").val('0');
    $("#discount_p").val('0');
    $("#available-stock > span").html("");
    $("#expiry-date > span").html("");
  } // else
});

// Print Bill
$("#print-bill").click(function(){
  var amount_paid = $("#amount-paid").val();
  var c_finalBill = Number($("#final-bill").html());   
  if(amount_paid < 1){
    alert("Add payment!");
  }
  else if(amount_paid < c_finalBill){
    alert("Amount paid is less than bill.");
  }
  else{        
    var cartStock="";
    $('#print-table tr > td').each(function(key,value) {
      var innerValue = value.innerHTML;
      if(innerValue.includes("strong")){
        return false;
      }  
      cartStock= cartStock+"|"+innerValue.replace("&amp;","&");
    });
    //console.info(cartStock);
    $.post("sell-process.php",{
      c_cartStock: cartStock,
      c_final_bill: c_finalBill,
    },
    function(data){
        //console.info(data);
        $("#bill-invoice").html(data);
        window.print();
        location.reload();
    });
  } // else
});

$(document).ready(function(){
    $("#product-name-sell").focus();    
    $( ".auto-date" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');
    $( "#auto-date" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');
    $( "#p-exp" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');
    $( "#from-datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');
    $( "#to-datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');

    var today = new Date();
    $("#auto-date-sell").html(today.toShortFormat());

    $('.date-mask').mask('0000-00-00');
});