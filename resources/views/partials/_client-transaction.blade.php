 <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">New Transaction</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <form method="POST" action="/transactions/store" class="user">
                 @csrf
                 <div class="modal-body">
                     <input type="hidden" name="transaction_id" value="TXN_{{rand(0, 1000).time()}}">
                     <input type="hidden" class="client_id" name="client_id" id="client_id">
                     <input type="hidden" class="cl_unit_price" name="unit_price" id="unit_price">
                     <input type="hidden" class="cl_disc_est" name="disc_est" id="disc_est">
                     <table class="col-md-12 w-100  p-0">
                         <tr>
                             <td class="col-md-6 px-2">
                                 <small>Name</small>
                                 <h4 class="name"></h4>
                             </td>
                             <td class="col-md-6 px-2">
                                 <small>Phone</small>
                                 <h4 class="phone"></h4>
                             </td>
                         </tr>

                         <tr>
                             <td class="col-md-6 px-2">
                                 <div class="form-group">
                                     <select class="form-control cl_category" id="cl_category" name="category" value="{{old('method')}}" placeholder="Quantity">
                                         <option value="Select KG">--Customer Category--</option>
                                         @forelse ($categories as $category )
                                         <option value="{{$category->price}}">{{$category->name}} - # {{$category->price}}</option>
                                         @empty
                                         <option value="No Category">No Category</option>
                                         @endforelse
                                     </select>
                                 </div>
                             </td>
                             <td class="col-md-6 px-2">
                                 <div class="form-group">
                                     <select class="form-control" id="method" name="method" value="{{old('method')}}" placeholder="Quantity">
                                         <option value="Select KG">--Payment Method--</option>
                                         <option value="Cash">Cash</option>
                                         <option value="POS">POS</option>
                                         <option value="Transfer">Transfer</option>
                                     </select>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td class="col-md-6 px-2">
                                 <div class="form-group d-flex">
                                     <label class="mr-2" for="discount"><small>Quantity: </small></label>
                                     <input class="form-control  font-weight-bold text-xl text-center cl_quantity" type="number" name="quantity" id="cl_quantity" placeholder="0 kg" value="{{old('buy_quantity')}}" />
                                     @error('quantity')
                                     <small class="text-danger">{{$message}}</small>
                                     @enderror
                                 </div>
                             </td>
                             <td class="col-md-6 px-2">
                                 <div class="form-group d-flex justify-content-between align-items-center">
                                     <label class="mr-2" for="discount"><small>Discount: </small></label>
                                     <input class="form-control cl_discount " type="number" name="discount" id="cl_discount" placeholder="Discount" value="0" />
                                     @error('discount')
                                     <small class="text-danger">{{$message}}</small>
                                     @enderror
                                 </div>
                             </td>

                         </tr>
                         <tr>
                             <td class="col-md-6 px-2">
                                 <div class="form-group">
                                     <input class="form-control cl_price" type="hidden" name="price" id="cl_price" placeholder="Total Price" value="{{old('price')}}" />
                                     @error('price')
                                     <small class="text-danger">{{$message}}</small>
                                     @enderror
                                 </div>

                             </td>
                         </tr>
                     </table>
                     <div class="display_price mx-auto text-center px-4">
                         <small>Total Price:</small>
                         <h4 class="mx-4 cl_price_display">#<span id="cl_price_display">000.00</span></h4>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <div class="form-group">
                         <input type="submit" class="btn btn-primary" value="Save Transaction" />
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>