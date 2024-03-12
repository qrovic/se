
var toast = new bootstrap.Toast(document.getElementById('myToast'));
toast._element.addEventListener('shown.bs.toast', function () {
    toast._element.click();
    document.getElementById('notifsound').play();
});




function updatetable() {
    $.ajax({
        url: '../database/fetchordersdetails.php',
        method: 'POST',
        dataType: 'json',
        success: function (data) {
            
            $('#orderTableBody').empty();
            $.each(data.storeorderspaid, function (index, storeorder) {
                $('#orderTableBody').append(`
                    <tr class="item-row storesrow">
                        <td class="ordernum">${storeorder.customerid}</td>
                        <td class="name">${storeorder.ordertime}</td>
                        <td class="action" onclick="$('#modal_${storeorder.customerid}').modal('show')"><button type="submit" class="btn btn-primary paybtnnonmodal" id="">Serve</button></td>
                    </tr>
                `);
            });
        },
        error: function (error) {
            console.error('Error fetching data: ', error);
        }
    });
}


updatetable();
setInterval(updatetable, 1000);


function updateModal() {
    $.ajax({
        url: '../database/fetchordersdetails.php',
        method: 'POST',
        dataType: 'json',
        success: function (data) {

            $.each(data.storeorderspaid, function (index, customerstoreorder) {
                var modalId = `modal_${customerstoreorder.customerid}`;

                if (!$(`#${modalId}`).length) {
                    var modalContent = `
                        <div class="modal fade ordersmodal" id="modal_${customerstoreorder.customerid}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog menumodal ordermodal">
                                <div class="modal-content modalorders menumodalcontent">
                                    <div class="modal-body modalbody">
                                        <p class="orderpaymenttxt">Order Payment</p/>
                                        <p class="customernumbertxt">Customer number:${customerstoreorder.customerid}</p/>
                                        <table class="table orderstable">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Variety</th>
                                                    <th>Size</th>
                                                   
                                                    <th>Quantity</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                    `;

                    $.each(data.customerstoreorder, function (itemIndex, cartdetail) {
                        if (cartdetail.customerid === customerstoreorder.customerid){
                        modalContent += `
                            <tr class="item-row">
                                <td class="itemnamecart">${cartdetail.itemname}</td>
                                <td class="itemvariant">${cartdetail.itemvariant}</td>
                                <td class="cartitemsize">${cartdetail.itemsize}</td>
                          
                                <td class="itemquantity">${cartdetail.quantity}
                                </td>
                                
                            </tr>
                        `;
                        }
                    });

                    modalContent += `
                                            </tbody>
                                        </table>
                                       
                                    </div>
                                    
                                    <div class="cashmodal">
                                    <form id="paymentForm" action="../database/served.php" method="POST">

                                        <div class="cashdiv">
                                            <div class="cashdivholder">
                                                
                                                <input type="hidden" name="storecustomerid" value="${customerstoreorder.customerid}">
                                                
                                              
                                            </div>
                                        </div>
                                    <div class="modalfooter">
                                        <button type="button" class="btn btn-primary paybtn closebtn" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        
                                        <button type="submit" class="btn btn-primary paybtn" id="submitbtn">
                                            Serve
                                        </button>
                                        
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    `;
                    $('#modalshere').append(modalContent);
                    document.querySelector('.table-max-height tbody').style.maxHeight = '200px';
                    toast.show();
                }
            });
        },
        error: function (error) {
            console.error('Error fetching data: ', error);
        }
    });
}
updateModal();
setInterval(updateModal, 1000);





$(document).ready(function () {
    $(document).on('shown.bs.modal', '.modal', function () {
        var currentModal = $(this);
        var paymentForm = currentModal.find("form");

        paymentForm.off('submit');
        paymentForm.on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: paymentForm.attr("action"),
                data: paymentForm.serialize(),
                success: function (response) {
                    currentModal.modal('hide'); 
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
});
