<div class="col-lg-12">
    <div id="chart"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.15.0/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.15/c3.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/seedrandom/3.0.1/seedrandom.min.js">

    </script>
  <style>
.c3 .c3-grid line {
background: black;
stroke-dasharray: initial;
}
        .chart{
  width: 100%;

}
  </style>
    <script>
        Math.seed = function (s) {
            return function () {
                s = Math.sin(s) * 10000;
                return s - Math.floor(s);
            };
        };
        const randomProperty = function (obj, s) {
            const keys = Object.keys(obj);
            Math.seed(s);
            return obj[keys[keys.length * Math.random() << 0]];
        };
        window.colors = {
            'blue': '#467fcf',
            'blue-darkest': '#0e1929',
            'purple': '#a55eea',
            'purple-darkest': '#21132f',
            'purple-darker': '#42265e',
            'purple-dark': '#844bbb',
            'purple-light': '#c08ef0',
            'red': '#e74c3c',
            'red-darkest': '#2e0f0c',
            'orange': '#fd9644',
            'orange-darkest': '#331e0e',
            'orange-light': '#feb67c',
            'yellow': '#f1c40f',
            'lime': '#7bd235',
            'lime-darkest': '#192a0b',
            'teal': '#2bcbba',
            'teal-darkest': '#092925',
            'teal-dark': '#22a295',
            'cyan-darkest': '#052025',
            'cyan-darker': '#09414a',
            'cyan-dark': '#128293',
            'cyan-light': '#5dbecd',
            'gray': '#868e96',
            'gray-darkest': '#1b1c1e',
            'gray-darker': '#36393c',
            'gray-dark': '#343a40',
            'gray-dark-darkest': '#0a0c0d',
            'gray-dark-darker': '#15171a',
            'gray-dark-dark': '#2a2e33',
        };
    </script>
    <script>
        (function () {
           //var data = JSON.parse(atob("<?php echo e(base64_encode(json_encode( $account->chartOf(request('type','daily'))))); ?>"));
           var data = JSON.parse(atob("<?php echo e(base64_encode(json_encode( $account->chartOf(request('type','dailybalance'))))); ?>"));
            console.log(data);
            c3.generate({
                          size: {
        height: 350,
    },
                bindto: '#chart', // id of chart wrapper
                data: {
                    columns:
                    data.columns,
                    colors: {
                        'sample': window.colors['gray-dark-darkest'],
                    },
                    names: {
                        // name of each series
                        'sample': 'Balance',
                    }, axes: {
                        sample: 'y2'
                    },
                },

                axis: {
                    x: {
                        type: 'category',
                        show: false,
                        categories: data.labels
                    },
                    y: {
                        show: false,
                    },
                    y2: {
                        show: true
                    }
                },
                grid: {
                    x: {
                        show: false,
                    },
                    y: {
                        show: true,
                        
                      
                    },
                },
                tooltip: {
                    show: true
                },
                point: {
                    show: true
                },
                legend: {
                    show: false, //hide legend
                },
                padding: {
                    bottom: 24,
                    top: 0
                },
            });
        })()
    </script>
</div>
<?php /**PATH /home/percen25/public_html/resources/views/client/line_chart.blade.php ENDPATH**/ ?>