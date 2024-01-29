
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
        }, { threshold: 0.4});

        // Observe each section
        document.querySelectorAll('section[id]').forEach(section => {
            observer.observe(section);
        });
    

    
        document.getElementById('searchforms').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.submit(); 
            }
        });
    

    
        function increaseValue() {
            var inputElement = document.getElementById('quantity');
            var currentValue = parseInt(inputElement.value, 10);

            if (!isNaN(currentValue) && currentValue < 100) {
                inputElement.value = currentValue + 1;
            }
        }

        function decreaseValue() {
            var inputElement = document.getElementById('quantity');
            var currentValue = parseInt(inputElement.value, 10);

            if (!isNaN(currentValue) && currentValue > 1) {
                inputElement.value = currentValue - 1;
            }
        }
    

    
        $(document).ready(function() {
            $('input[name="menuvariation"], input[name="menusize"]').change(function() {
                var selectedVariety = $('input[name="menuvariation"]:checked').val();
                var selectedSize = $('input[name="menusize"]:checked').val();
                var menuid = $('.modal.show').data('currentmenuid');

                $.ajax({
                    url: '../database/fetchmenudetails.php',
                    method: 'POST',
                    data: {
                        variety: selectedVariety,
                        size: selectedSize,
                        menuid: menuid
                    },
                    success: function(response) {
                        $('.menuprice').text(response);
                    }
                });
            });
        });