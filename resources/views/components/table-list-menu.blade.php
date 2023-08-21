@props(['show', 'id', 'delete'])
<div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-ellipsis-h"></i>
         </a>
         <div class="dropdown-list dropdown-menu dropdown-menu-left shadow-sm " aria-labelledby="alertsDropdown">
            
             <a class="dropdown-item d-flex align-items-center" href='{{url($show, $id)}}'>
                 <div class="mr-3">
                         <i class="fa fa-eye"></i>
                 </div>
                 <div>
                     <div class="small text-gray-500">View & Edit Info</div>
                 </div>
             </a>
             {{-- @if ($approve)
                 <a class="dropdown-item d-flex align-items-center" href='{{url($approve, $id)}}'>
                 <div class="mr-3">
                         <i class="fa fa-plus "></i>
                 </div>
                 <div>
                     <div class="small text-gray-500">Approve Appointments</div>
                 </div>
             </a>
             @endif --}}
             
             <a class="dropdown-item d-flex align-items-center" onclick="alert('Are sure you want to delete this record?')" href="{{url($delete, $id)}}" >
                 <div class="mr-3">
                         <i class="fa fa-trash"></i>
                 </div>
                 <div>
                     <div  class="small text-gray-500">Delete</div>
                 </div>
             </a>
                       
        </div>
                        </div>