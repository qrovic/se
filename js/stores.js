
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

            $.each(data.storeorders, function (index, storeorder) {
                $('#orderTableBody').append(`
                    <tr class="item-row storesrow">
                        <td class="ordernum">${storeorder.customerid}</td>
                        <td class="name">${storeorder.ordertime}</td>
                        <td class="price"><span>₱</span>${storeorder.totalprice}</td>
                        <td class="action" onclick="$('#modal_${storeorder.customerid}').modal('show')"><button type="submit" class="btn btn-primary paybtnnonmodal" id="">Pay</button></td>
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

            $.each(data.storeorders, function (index, customerstoreorder) {
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
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
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
                                <td class="itemprice">₱${cartdetail.itemprice}</td>
                                <td class="itemquantity">${cartdetail.quantity}
                                </td>
                                <td class="total total-price">
                                    <span class="totalprice">₱${cartdetail.totalprice}</span>
                                </td>
                            </tr>
                        `;
                        }
                    });

                    modalContent += `
                                            </tbody>
                                        </table>
                                        <p class="totalpricenonmodal cashtxt">Total:&nbsp;&nbsp;&nbsp;<span class="pesosign">₱</span><span class="totalinputmodal" id="totalInput">${customerstoreorder.totalprice}</span></p>
                                    </div>
                                    
                                    <div class="cashmodal">
                                    <form id="paymentForm" action="../database/paid.php" method="POST">

                                        <div class="cashdiv">
                                            <div class="cashdivholder">
                                                <input type="hidden" name="total" value="${customerstoreorder.totalprice}">
                                                <input type="hidden" name="storecustomerid" value="${customerstoreorder.customerid}">
                                                <p class="cashtxt">Cash:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="pesosign">₱</span><input class="cashtendered" name="cash" id="cashInput" type="number"></p>
                                                <p class="cashtxt">Change: <span class="modalchange"></span></p>
                                            </div>
                                        </div>
                                    <div class="modalfooter">
                                        <button type="submit" class="btn btn-primary paybtn closebtn" id="">
                                            Close
                                        </button>
                                        
                                        <button disabled type="submit" class="btn btn-primary paybtn" id="submitbtn">
                                            Pay
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






$(document).ready(function() {
    var originalTotal, originalCashTendered;

    $(document).on('shown.bs.modal', '.ordersmodal', function () {
        var modal = $(this);
        var total = parseFloat(modal.find('.totalinputmodal').text()) || 0;
        originalCashTendered = parseFloat(modal.find('.cashtendered').val()) || 0;
        modal.find('.cashtendered').on('input', updateChange);
    });
    $(document).on('hidden.bs.modal', '.ordersmodal', function () {
        var modal = $(this);
        modal.find('.totalinputmodal, .cashtendered').val(function() {
            return this.className === 'totalinputmodal' ? originalTotal : originalCashTendered;
        });

        modal.find('.modalchange').text("0.00");
    });
    
    function updateChange() {
        var modal = $(this).closest('.ordersmodal');
        var total = parseFloat(modal.find('.totalinputmodal').text()) || 0;
        var cashTendered = parseFloat(modal.find('.cashtendered').val()) || 0;
        modal.find('.modalchange').text("₱" + (cashTendered - total).toFixed(2));

        if ((cashTendered - total) <= 0) {
            modal.find('#submitbtn').prop('disabled', true);

            modal.find('.cashtendered').on('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                }
            });
        } else {
            modal.find('#submitbtn').prop('disabled', false);
            modal.find('.cashtendered').off('keydown');
        }
    }

});


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
