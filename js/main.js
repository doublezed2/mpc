Date.prototype.toShortFormat = function() {
var day = this.getDate();
var month = this.getMonth() + 1;
var year = this.getFullYear();

return "" + day + "-" + month + "-" + year;
}

$(function() {
  $("#product-name-po").autocomplete({
    source: "read-products.php",
    select: function( event, ui ) {
      event.preventDefault();
      $('#product-name-po').val(ui.item.label);
      $('#product-up').val(ui.item.value);
    }
  });
});
$(function() {
  $("#product-name-sell").autocomplete({
    source: "read-stock.php",
    select: function( event, ui ) {
      event.preventDefault();
      $('#product-name-sell').val(ui.item.label);
      var str_arr = ui.item.value;
      var split_arr = str_arr.split("|");
      $('#product-up').val(split_arr[0]);
      $('#discount_p').val(split_arr[1]);
      $("#available-stock > span").html(split_arr[2]);

    }
  });
});
$("#add-po").click(function(){
    var pName =     $("#product-name-po").val();
    var pDist =     $("#p-dist").val();
    var pComp =     $("#p-comp").val();    
    var pType =     $("#p-type").val();    
    var pInvoice =  $("#p-invoice").val();    
    var pDate =     $("#auto-date").val();    
    var pQty =      $("#p-qty").val();    
    var pPacking =  $("#packing").val();    
    var pBatch =    $("#p-batch").val();    
    var pExp =      $("#p-exp").val();    
    var pRp =       $("#rp").val();
    var pTp =       $("#tp").val();
    var pUp =       $("#up").val();    
    
    $.post("add-purchase-order-process.php",{
        p_name: pName,
        p_dist: pDist,
        p_comp: pComp,
        p_type: pType,
        p_inv: pInvoice,
        p_date: pDate,
        p_pck: pPacking,
        p_batch: pBatch,
        p_exp: pExp,
        p_rp: pRp,
        p_tp: pTp,
        p_up: pUp,
        p_qty: pQty
    },
    function(data){
        alert(data);
        $("#product-name-po").val(''); $("#p-qty").val('');$("#packing").val(''); $("#p-batch").val(''); $("#p-exp").val(''); $("#rp").val('');$("#tp").val('');$("#up").val('');  
    });
});


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

$(document).ready(function(){
    $("#product-name-sell").focus();
    
    $( "#auto-date" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');
    $( "#p-exp" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');
    $( "#from-datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');
    $( "#to-datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', 'today');

    $("#add-p-btn").click(function(){
      var p_quantity = $("#product-quantity").val();
      if(p_quantity == 0 ){
        alert("Please add Quantity");
        $("#product-quantity").focus();
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
        
        $("#print-table").append('<tr> <td><a class="remove-item-btn" href="#">X</a></td> <td>'+p_name+'</td><td>'+p_up+'</td><td>'+p_quantity+'</td><td>'+subTotal+'</td><td class="hide-all">'+discount_amount+'</td></tr>');
        $("#totalBill-row").remove();
        $("#discount-row").remove();
        $("#finalBill-row").remove();
        
        $("#print-table").append('<tr id="totalBill-row"><td></td><td><strong>Sub-Total</strong></td><td></td><td></td><td>'+totalBill+'</td></tr>');
        $("#print-table").append('<tr id="discount-row"><td></td><td><strong>Discount</strong></td><td></td><td></td><td>'+totalDiscount+'</td></tr>');
        $("#print-table").append('<tr id="finalBill-row"><td></td><td><strong>Total</strong></td><td></td><td></td><td><strong><span id="final-bill">'+finalBill+'</span></strong></td></tr>');
        

        $("#product-name-sell").val('');
        $("#product-quantity").val('');
        $("#product-up").val('');
        $("#available-stock > span").html("");
      } // else
    });

    $("#amount-paid").keyup(function(){
      var amountPaid = Number(parseFloat($("#amount-paid").val()).toFixed(2));
      var finalAmount = Number(parseFloat($("#final-bill").html()).toFixed(2));
      var amountReturn =  Number(parseFloat(amountPaid - finalAmount).toFixed(0)); 
      $("#amount-return").val(amountReturn);      
    });

    
    $("#rp").keyup(function(){
      var p_type = $("#p-type").val();
      var rp = $("#rp").val();
      var pck = $("#packing").val();
      if(p_type == "medicine"){
        var tp = Number(parseFloat(rp - (rp * 0.15)).toFixed(2)); 
      }
      else{
        var tp = rp;
      }
      $("#tp").val(tp);
      $("#up").val(parseFloat(rp/pck).toFixed(2));
    });

    $("#tp").keyup(function(){
      var p_type = $("#p-type").val();
      var tp = parseFloat($("#tp").val());
      var pck = $("#packing").val();
      if(p_type == "costmetics"){
        var rp = Number(parseFloat( tp + (tp * 0.1)).toFixed(2));
      }
      $("#rp").val(rp);
      $("#up").val(parseFloat(rp/pck).toFixed(2));
      
    });

    var today = new Date();
    $("#auto-date-sell").html(today.toShortFormat());
    
    $("#print-bill").click(function(){
      var amount_paid = $("#amount-paid").val();
      if(amount_paid < 1){
        alert("Add payment!");
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
        var c_finalBill = $("#final-bill").html();   
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

});