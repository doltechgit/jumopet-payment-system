 <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Confirm Transaction</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>

             <div class="modal-body">
                 <input type="hidden" name="transaction_id" value="TXN_{{rand(0, 1000).time()}}">
                 <input type="hidden" name="product_id" id="product_id">
                 <input type="hidden" name="unit_price" id="unit_price">
                 <input type="hidden" name="disc_est" id="disc_est">
                 <table class="col-md-12 w-100  p-0">
                     <tr>
                         <td class="">Name:</td>
                         <td class=" px-2" id="confirm_name"> </td>
                     </tr>
                     <tr>
                         <td class="">Phone:</td>
                         <td class=" px-2" id="confirm_phone"></td>
                     </tr>
                     <tr>
                         <td class="">Email:</td>
                         <td class=" px-2" id="confirm_email"> </td>
                     </tr>
                     <tr>
                         <td class="">Address:</td>
                         <td class=" px-2" id="confirm_address"></td>
                     </tr>
                     <tr>
                         <td class="">Category:</td>
                         <td class=" px-2" id="confirm_category"></td>
                     </tr>
                     <tr>
                         <td class="">Payment Method:</td>
                         <td class=" px-2" id="confirm_method"></td>
                     </tr>
                     <tr>
                         <td class="">Quantity:</td>
                         <td class=" px-2" id="confirm_buy_quantity"></td>
                     </tr>
                     <tr>
                         <td class="">Discount:</td>
                         <td class=" px-2" id="confirm_discount"></td>
                     </tr>
                     <tr>
                         <td class="">Price:</td>
                         <td class=" px-2" id="confirm_buy_price"></td>
                     </tr>
                     <tr>
                         <td class="">Paid:</td>
                         <td class=" px-2" id="confirm_paid"></td>
                     </tr>
                     <tr>
                         <td class="">Balance:</td>
                         <td class=" px-2" id="confirm_balance"></td>
                     </tr>
                 </table>


             </div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 <button class="btn btn-primary confirm_btn">Confirm Transaction</button>
             </div>
         </div>
     </div>
 </div>