function updatevoice() {
    $.ajax({
        url: '../database/fetchordersdetails.php',
        method: 'POST',
        dataType: 'json',
        success: function (data) {
            
            $.each(data.storequeuepreparing, function (index, storeorder) {
                var pid = `p_p${storeorder.customerid}`;
                if (!$(`#${pid}`).length) {
                    var txt = `Preparing order number ${storeorder.customerid}`;
                    txttospeech(txt);   
                }
            });
            $.each(data.storequeuecollect, function (index, storeorder1) {
                var pid = `p_c${storeorder1.customerid}`;
                if (!$(`#${pid}`).length) {
                    var txt = `Serving order number ${storeorder1.customerid}`;
                    txttospeech(txt);   
                }
            });
            
        },
        error: function (error) {
            console.error('Error fetching data: ', error);
        }
    });
}

updatevoice();
setInterval(updatevoice, 500);




function txttospeech(text) {
    responsiveVoice.speak(text);
}

function updatep() {
    $.ajax({
        url: '../database/fetchordersdetails.php',
        method: 'POST',
        dataType: 'json',
        success: function (data) {
            $('#preparingdiv').empty();
            $.each(data.storequeuepreparing, function (index, storeorder) {
                $('#preparingdiv').append(`
                    <p class="preparingorderid" id=p_p${storeorder.customerid}>${storeorder.customerid}</p>
                `);
                
            });

            $('#collectdiv').empty();
            $.each(data.storequeuecollect, function (index, storeorder1) {
                $('#collectdiv').append(`
                    <p class="collectorderid" id=p_c${storeorder1.customerid}>${storeorder1.customerid}</p>
                `);
                
            });
            
        },
        error: function (error) {
            console.error('Error fetching data: ', error);
        }
    });
}

updatep();
setInterval(updatep, 1000);






