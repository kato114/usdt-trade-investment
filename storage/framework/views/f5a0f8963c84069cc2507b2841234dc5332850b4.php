<div class="card">
    <div class="card-header">
        <p class="card-title">
            Potential Profit Calculator
        </p>
    </div>
    <div class="table-responsive" style="background: #e5e9ea">
        <b class="ml-3 d-inline-block">
            <br>
            <b>PAST PERFORMANCE IS NOT A GUARANTEE OF FUTURE PROFITS.</b>
            <br>
            <br>
          <?php if($client->commission=='100.00'): ?>
  <span>This is based on 40% monthly compounding.</span>
<?php else: ?>
  <span>This is based on 19% monthly compounding.</span>
<?php endif; ?>  
          
          
            <br>
            <br>
        </b>
        <table class="table card-table table-striped">
            <tbody>
            <tr style="
    background: #cccccc;
" class="">
                <td>Initial Amount
                    <span class="float-right ">Please enter amount here</span>
                </td>
                <td><input type="number" id="profit" placeholder="Amount"
                           onchange="calcProfit()" onkeyup="calcProfit()"
                           value="1000"></td>
            </tr>
            <tr class="bg-light">
                <td>One Month</td>
                <td>5000</td>
            </tr>
            <tr class="bg-light">
                <td>Two Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Three Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Four Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Five Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Six Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Seven Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Eight Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Nine Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Ten Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Eleven Months</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>One Year</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Two Years</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Three Years</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Four Years</td>
                <td>6000</td>
            </tr>
            <tr class="bg-light">

                <td>Five Years</td>
                <td>6000</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
    <script>

        function compoundInterest(amount, interest, months) {
            const n = 1;
            return (amount * Math.pow((1 + (interest / (n * 100))), (n * months)));
        }
<?php if($client->commission=='100.00'): ?>
        function calcProfit() {
            const rate = 40;
            const rows = $('table').find("tr");
            const amount = $(rows[0]).find("input").val();
            for (i = 1; i < rows.length; i++) {
                var value = 0;
                if (i <= 12) {
                    value = compoundInterest(amount, rate, i).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                } else {
                    value = compoundInterest(amount, rate, ((i - 12) + 1) * 12).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                }
                $(rows[i]).find("td:eq(1)").html(value)
            }
        }
<?php else: ?>
        function calcProfit() {
            const rate = 19;
            const rows = $('table').find("tr");
            const amount = $(rows[0]).find("input").val();
            for (i = 1; i < rows.length; i++) {
                var value = 0;
                if (i <= 12) {
                    value = compoundInterest(amount, rate, i).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                } else {
                    value = compoundInterest(amount, rate, ((i - 12) + 1) * 12).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                }
                $(rows[i]).find("td:eq(1)").html(value)
            }
        }
<?php endif; ?>  
      
      


        calcProfit();
    </script>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
<?php $__env->appendSection(); ?>
<?php /**PATH /home/paulsclub/public_html/real-profits.com/resources/views/client/calculator.blade.php ENDPATH**/ ?>