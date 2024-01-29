
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
?>
<body>
    <div class="left">
        <div class="options">
            <ul class="options">
                <li class="options">
                    <a href="overview.php">Overview</a>
                </li>
                <li class="options">
                    <a href="overview.php">Accounts</a>
                </li>
                <li class="options">
                    <a href="overview.php">Sales</a>
                </li>
                <li class="options">
                    <a href="overview.php">Settings</a>
                </li>
                <li class="options logout">
                    <a href="overview.php">Logout</a>
                </li>
            </ul>
            
        </div>
    </div>
    <div class="right">
        <h1>Add Store</h1>
        <div class="addstore">
            <div class="storedetails">
                <h2>Store Details</h2>
                <form action="../database/addstore.php" method="POST" enctype="multipart/form-data">
                    <div class="addstoreinput">
                        <label for="">Store ID:</label>
                        <input type="number" name="storeid" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Product Name:</label>
                        <input type="text" name="productname" id="">
                    </div>
                    <div class="addstoreinput">
                        <label for="">Category:</label>
                        <select name="category" id="">
                            <option value="Drinks">Drinks</option>
                            <option value="Drinks">Meals</option>
                            <option value="Drinks">Snacks</option>
                            <option value="Drinks">Desserts</option>
                            <option value="Drinks">Items</option>  
                        </select>
                    </div>
                    <div class="addstoreinput">
                        <label for="">Store Pic:</label>
                        <input type="file" name ="itempic" src="" alt="">
                    </div>
            </div>
            <div class="ownerdetails" id="ownerdetails">
                    <h2>Owner Details</h2>
                    
                    <div class="">
                        <button type="button" onclick="addVariant()">Add Variant</button>
                        <label for="">Variant:</label>
                        <input type="text" name="itemvariants[]" id="">
                    </div>
                    
                    <div class="" id="">
                        <button type="button" class="addsizebtn" onclick="addSize()">Add Size</button>
                        <div class="size" id="size">
                            <div class="size-container">
                                <div class="addstoreinput">
                                    <label for="">Size:</label>
                                    <input type="text" name="itemsizes[]">
                                </div>

                                <div class="addstoreinput">
                                    <label for="">Price:</label>
                                    <input type="number" name="itemprices[]">
                                </div>

                                <div class="addstoreinput">
                                    <label for="">Stock:</label>
                                    <input type="number" name="itemstocks[]">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
            </div>  
            <input class="btn btn-primary" type="submit" value="submit">
                    </form>
        </div>
        
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
                
            </div>
                </form>
            </div>
        </div>
    </div>

    <div class="addvariant" hidden>
        <button type="button" onclick="addVariant()">Add Variant</button>
        <label for="">Variant:</label>
        <input type="text" name="itemvariants[]" id="">
    </div>
    <div class="itemsize" id="itemsize" hidden>
        <button type="button" class="addsizebtn" onclick="addSize()">Add Size</button>
        <div class="size" id="size">
            <div class="sizesfsfcontainer">
                <div class="addstoreinput">
                    <label for="">Size:</label>
                    <input type="text" name="itemsizes[]">
                </div>

                <div class="addstoreinput">
                    <label for="">Price:</label>
                    <input type="number" name="itemprices[]">
                </div>

                <div class="addstoreinput">
                    <label for="">Stock:</label>
                    <input type="number" name="itemstocks[]">
                </div>
            </div>
        </div>
    </div>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
<script>
    function addVariant() {
        var clone = document.querySelector('.addvariant').cloneNode(true);
        document.getElementById('ownerdetails').appendChild(clone);
        clone.removeAttribute('hidden');
        var clone = document.querySelector('.itemsize').cloneNode(true);
        document.getElementById('ownerdetails').appendChild(clone);
        clone.removeAttribute('hidden');    
        
    }

    function addSize() {
        var sizeContainer = document.querySelector('.sizecontainer').cloneNode(true);
        document.getElementById('size').appendChild(sizeContainer);

    }
</script>

</html>