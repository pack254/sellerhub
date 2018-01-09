<script>
$(document).ready( function() {

      //ใช่สำหรับแก้ bug class "modal-backdrop" แสดงผล 2 รอบ
      $("#myModal").on("shown.bs.modal", function () {
            //ถ้ามี class "modal-backdrop" มากกว่า 1 class .ให้ทำการลบ class "modal-backdrop" ที่เหลือออก
            if ($(".modal-backdrop").length > 1) {
                $(".modal-backdrop").not(':first').remove();
            }
      })

      $("#myModal").on("hidden.bs.modal", function () {
            //ลบ class "modal-backdrop"
             $('.modal-backdrop').remove();
      })

      // เมื่อ user กด click ปุ่ม edit set up ฟอร์มและแสดง ฟอร์มสำหรับ แก้ไขข้อมูล
      $(document).on('click', '.edit-modal', function() {
           $('.error').addClass('hidden');
           $('.update-sucess').css("display","none");
           $('.create-sucess').css("display","none");
           $('.modal-dialog').css("margin-top","120px");
           $('.delete-sucess').hide();
           $('.actionBtn').show();
           $('.form-group').show();
           $('#footer_action_button').text(" Update");
           $('#footer_action_button').addClass('glyphicon-check');
           $('#footer_action_button').removeClass('glyphicon-trash');
           $('.actionBtn').addClass('btn-success');
           $('.actionBtn').removeClass('btn-danger');
           $('.actionBtn').removeClass('create');
           $('.actionBtn').removeClass('delete');
           $('.actionBtn').removeClass('create-new-product');
           $('.actionBtn').addClass('edit');
           $('.modal-title').text('แก้ไข ข้อมูลลูกค้า');
           $('.deleteContent').hide();
           $('.form-horizontal').show();
           var details = $(this).data('info').split(',');
           fillmodalData(details);
           $('#myModal').modal('show');
           $('.form-group').removeClass('hidden');
       })


      // fillmodalData ใส่ข้อมูลที่ user ต้องการ edit ลงไปใน madal ฟอร์ม
       function fillmodalData(details){
          $('#fid').val(details[0]);
          $('#fname').val(details[1]);
          $('#lname').val($.trim(details[2]));
          $('#address').val(details[3]);
          $('#email').val(details[4]);
          $('#phone').val(details[5]);
        }
      //when the use click on edit button it will be updated new information to the database
       $('.modal-footer').on('click', '.edit', function(){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'post',
                url: '/editItem',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#fid").val(),
                    'fname': $('#fname').val(),
                    'lname': $('#lname').val(),
                    'address': $('#address').val(),
                    'email': $('#email').val(),
                    'phone': $('#phone').val(),
                },
                success: function(data){
                    if (data.errors){
                      $('#myModal').modal('show');
                      $('update-sucess').remove();
                      if(data.errors.fname) {
                          $('.fname_error').removeClass('hidden');
                          $('.fname_error').text("ชื่อ ไม่สามารถเว้นว่างไว้ได้ และ เป็นตัวอักษรเท่านั้น โปรด ระบุชื่อ");
                      }
                      if(data.errors.lname) {
                          $('.lname_error ').removeClass('hidden');
                          $('.lname_error').text("นามสกุล ไม่สามารถเว้นว่างไว้ได้ และ เป็นตัวอักษรเท่านั้น โปรด ระบุนามสกุล");
                      }
                      if(data.errors.address) {
                          $('.address_error').removeClass('hidden');
                          $('.address_error').text("ที่อยู่ ไม่สามารถเว้นว่างไว้ได้ โปรด ระบุที่อยู่");
                      }
                      if(data.errors.email) {
                          $('.email_error').removeClass('hidden');
                          $('.email_error').text("อีเมลล์ ไม่ถูกต้อง โปรดกรอกอีเมลล์อีกครั้ง");
                      }
                      if(data.errors.phone) {
                          $('.phone_error').removeClass('hidden');
                          $('.phone_error').text("เบอร์โทรศัพท์ ไม่ถูกต้อง โปรดกรอกเบอร์โทรศัพท์์อีกครั้ง");
                      }
                    } else {
                         table.ajax.reload();
                         $('.error').addClass('hidden');
                         $('#myModal').modal('show');
                         $('.update-sucess').css("display","block");
                    }
                }
            });
         });

        //when the use click on delete button it will be deleted information from the database
        //This function it uses Ajax request to serverside
         $('.modal-footer').on('click', '.delete', function() {
              $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
              });

              $.ajax({
                  type: 'post',
                  url: '/deleteItem',
                  data: {
                      '_token': $('input[name=_token]').val(),
                      'id': $('.did').text()
                  },
                  dataType: 'json',
                  success: function(data) {
                       table.ajax.reload();
                       $('#myModal').modal('show');
                       $('.form-group').css("display","none");
                       $('.actionBtn').css("display","none");
                       $('.dname').css("display","none");
                        $('.deleteContent').css("display","none");
                       $('.delete-sucess').css("display","block");
                  }
              });
          });
        //When the user clicks on the delete botton at the table it fills the information
        //to Modal form automatilly, and prompt up the message
         $(document).on('click', '.delete-modal', function() {
            $('.error').addClass('hidden');
            $('.update-sucess').css("display","none");
            $('.create-sucess').css("display","none");
            $('.modal-dialog').css("margin-top","160px");
            $('.actionBtn').show();
            $('.delete-sucess').hide();
            $('.dname').css("display","block");
            $('.deleteContent').css("display","none");
            $('#footer_action_button').text(" Delete");
            $('#footer_action_button').removeClass('glyphicon-check');
            $('#footer_action_button').addClass('glyphicon-trash');
            $('.actionBtn').removeClass('btn-success');
            $('.actionBtn').addClass('btn-danger');
            $('.actionBtn').removeClass('edit');
            $('.actionBtn').removeClass('create');
            $('.actionBtn').removeClass('create-new-product');
            $('.actionBtn').addClass('delete');
            $('.modal-title').text('Delete');
            $('.deleteContent').show();
            $('.form-horizontal').hide();
            var stuff = $(this).data('info').split(',');
            $('.did').text(stuff[0]);
            $('.dname').html(stuff[1] +" "+stuff[2]);
            $('#myModal').modal('show');
        });




        $(document).on('click', '.create-new-product', function() {
            $('.create-sucess').css("display","none");
            $('.update-sucess').css("display","none");
            $('.delete-sucess').hide();
            $('.modal-dialog').css("margin-top","120px");
            $('.actionBtn').show();
            $('.form-group').show();
            $('#footer_action_button').text("Create");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').removeClass('delete');
            $('.actionBtn').removeClass('edit');
            $('.actionBtn').removeClass('create-new-product');
            $('.actionBtn').addClass('create');
            $('.modal-title').text('เพิ่มข้อมูลลูกค้าใหม่');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            clearModalData();
            $('#myModal').modal('show');
            $('.form-group').removeClass('hidden');
            $('.cus-id').removeClass('show');
            $('.cus-id').hide();
       });

       function clearModalData(){
            $('#fid').val('');
            $('#fname').val('');
            $('#lname').val('');
            $('#address').val('');
            $('#email').val('');
            $('#phone').val('');
        }

        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });

        var table = $('#example2').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('serverSideCustomer')}}',
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
                {data: 'rownum', name: 'rownum'},
                {data: 'customer_firstname', name: 'customer_firstname'},
                {data: 'customer_lastname', name: 'customer_lastname'},
                {data: 'customer_address', name: 'customer_address'},
                {data: 'customer_phone', name: 'customer_phone'},
                {data: 'customer_email', name: 'customer_email'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],

        });

        $('.modal-footer').on('click', '.create', function(){
             $.ajaxSetup({
                 headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             $.ajax({
                 type:'post',
                 url: '/createItem',
                 data: {
                     '_token': $('input[name=_token]').val(),
                     'id': $("#fid").val(),
                     'fname': $('#fname').val(),
                     'lname': $('#lname').val(),
                     'address': $('#address').val(),
                     'email': $('#email').val(),
                     'phone': $('#phone').val(),
                 },
                 success: function(data){
                     if (data.errors){
                       $('#myModal').modal('show');
                       $('update-sucess').remove();
                       if(data.errors.fname) {
                           $('.fname_error').removeClass('hidden');
                           $('.fname_error').text("ชื่อ ไม่สามารถเว้นว่างไว้ได้ และ เป็นตัวอักษรเท่านั้น โปรด ระบุชื่อ");
                       }
                       if(data.errors.lname) {
                           $('.lname_error ').removeClass('hidden');
                           $('.lname_error').text("นามสกุล ไม่สามารถเว้นว่างไว้ได้ และ เป็นตัวอักษรเท่านั้น โปรด ระบุนามสกุล");
                       }
                       if(data.errors.address) {
                           $('.address_error').removeClass('hidden');
                           $('.address_error').text("ที่อยู่ ไม่สามารถเว้นว่างไว้ได้ โปรด ระบุที่อยู่");
                       }
                       if(data.errors.email) {
                           $('.email_error').removeClass('hidden');
                           $('.email_error').text("อีเมลล์ ไม่ถูกต้อง โปรดกรอกอีเมลล์อีกครั้ง");
                       }
                       if(data.errors.phone) {
                           $('.phone_error').removeClass('hidden');
                           $('.phone_error').text("เบอร์โทรศัพท์ ไม่ถูกต้อง โปรดกรอกเบอร์โทรศัพท์์อีกครั้ง");
                       }
                     } else {

                          table.ajax.reload();
                          $('.error').addClass('hidden');
                          $('.form-group').addClass('hidden');
                          $('#myModal').modal('show');
                          $('.actionBtn').removeClass('create');
                          $('.create-sucess').css("display","block");
                          $('.actionBtn').addClass('create-new-product');
                          $('#footer_action_button').text("เพิ่มลูกค้าใหม่");
                     }
                 }
             });
          });
     })
</script>
