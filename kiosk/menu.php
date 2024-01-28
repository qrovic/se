
<!DOCTYPE html>
<html lang="en">
<?php
    require_once ("../include/head.php");
    require_once('../include/js.php');
    require_once('../database/datafetch.php');
       
?>
<body class="storebody">
    <div class="header">
        <img class="kioskstorelogo" src="../resources/foodparklogo.png" alt="hhee" onclick="window.location.href='stores.php'">
    </div>
    <div class="storeheader">
        <div class="menustorename">
            <p><?php if (isset($_POST['storename'])) { echo $_POST['storename']; } ?></p>
        </div>
        <div class="menusearch">
        <form action="menusearch.php" method="POST" id="searchforms">
            <input class="menusearch" type="text" name="itemsearch" id="" placeholder="Search for stores and menu">
            <input type="text" class="" hidden name="storename" value="<?php echo $_POST['storename'];?>">
            
            </form>
            <div class="categories">
                <ul>
                    
                    <?php if ($categories) {
                        foreach ($categories as $category) {
                        ?>
                        <li><a href="#<?php echo $category['category'];?>" ><?php echo $category['category'];?></a></li>
                        
                        <?php
                        }
                    }
                    ?>
                </ul>
                
            </div>
        </div>
        
    </div>
    <div class="storemenus">
        <div class="storeitems">
            <?php
            if ($categories) {
                foreach ($categories as $category) {
                    $item = $category['category'];
                    ?>
                    <div class="categoryitem">
                    
                        <section id="<?php echo $category['category']; ?>">
                        <div class="categoryname">
                            <p><?php echo $category['category']; ?></p>
                        </div>
                        <div class="itemsdiv">
                        <?php
                        foreach ($$item as $nope) {
                            
                        ?>
                            <div class="storeitem">
                                <div class="itemdetails">
                                    <p class="itemname"><?php echo $nope['item_name'] ?></p>
                                    <p class="itemprice">from ₱<?php echo rand(50, 199); ?></p>
                                </div>
                                <img class="itemlogo" src="<?php echo "../resources/" . $nope['item_pic']; ?>" alt="Store Logo">
                            </div>
                        
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                    </section>
                <?php
                }
            }
            ?>
        </div>
    </div>

</body>
<script>
        // Add event listeners for click events on anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelectorAll('a[href^="#"]').forEach(a => {
                    a.classList.remove('active');
                });

                this.classList.add('active');

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Use Intersection Observer to handle scroll events
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                const id = entry.target.getAttribute('id');
                const link = document.querySelector(`a[href="#${id}"]`);

                if (entry.isIntersecting) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }, { threshold: 0.5 }); // Adjust the threshold as needed

        // Observe each section
        document.querySelectorAll('section[id]').forEach(section => {
            observer.observe(section);
        });
    </script>
<script>
    document.getElementById('searchforms').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.submit(); 
        }
    });
</script>

</html>