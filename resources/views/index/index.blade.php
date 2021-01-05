<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>25 Percent</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png"/>
  <link rel="stylesheet" href="assets/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/css/icofont.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/lightcase.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
  <link rel="stylesheet" href="assets/css/nice-select.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

  <!-- preloader start -->
  <div class="preloader">
    <div class="preloader-box">
      <div>L</div>
      <div>O</div>
      <div>A</div>
      <div>D</div>
      <div>I</div>
      <div>N</div>
      <div>G</div>
    </div>
  </div>
  <!-- preloader end -->
  <!--  header-section start  -->
  <header class="header-section">
    <div class="header-top">
      <div class="container text-center">
        <span class="text-danger" style="font-weight: 700; font-size: 26.3px;">Since the start of the COVID situation, we have helped 1000's pay their bills.</span>
      </div>
    </div>
    <!--<div class="header-top">-->
    <!--  <div class="container">-->
    <!--    <div class="row justify-content-between">-->
    <!--      <div class="col-lg-6 col-md-6 col-sm-6">-->
    <!--        <div class="header-top-left d-flex">-->
    <!--          <div class="support-part">-->
    <!--              <a href="."><i class="fa fa-headphones"></i>Support</a>-->
    <!--          </div>-->
    <!--          <div class="email-part">-->
    <!--              <a href="mailto:support@25-percent.com"><i class="fa fa-envelope"></i>support@25-percent.com</a>-->
    <!--          </div>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--      <div class="col-lg-4 col-md-4 col-sm-6">-->
    <!--          <div class="header-top-right d-flex align-items-center justify-content-end">-->
    <!--              <div class="language-part">-->
    <!--                <i class="fa fa-globe"></i>-->
    <!--                Eng-->
    <!--              </div>-->
    <!--          </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
    <div class="header-bottom">
      <div class="container">
        <nav class="navbar navbar-expand-xl">
          <!--<a class="site-logo site-title" href="#home"><img src="assets/images/logo.png" alt="site-logo" style="max-height: 60px;"></a>-->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="menu-toggle"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav main-menu mx-auto">
              <li><a href="#home"><b>Home</b></a></li>
              <li><a href="#calc"><b>Profit Calculator</b></a></li>
              <li><a href="#transaction"><b>Transactions</b></a></li>
              <li><a href="#affprog"><b>Affiliate Program</b></a></li>
              <li><a href="#faq"><b>FAQ</b></a></li>
              <li><a href="#contact"><b>contact us</b></a></li>
              <li><a href="{{ url('public/login') }}"><b>Login</b></a></li>
          </ul>
          </div>
        </nav>
      </div>
    </div><!-- header-bottom end -->
  </header>
  <!--  header-section end  -->
  
  <!-- banner-section start -->
  <section id="home" class="banner-section">
    <div class="banner-elements-image anim-bounce"><img src="assets/images/elements/banner.png" alt="image"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-8">
          <div class="banner-content-area">
            <div class="banner-content">
              
              <h2 class="banner-title" >Build Your Future With Investments</h2>
              <p>We are a worldwide investment company that is committed to the principle of revenue maximization & reduction of the financial risks with investing.</p>
            </div>
            <div class="banner-btn-area">
              <a href="https://25-percent.com/public/login" class="btn btn-primary btn-sign-in" target="_parent">get started now!</a>
            </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner-section end -->

  <!-- counter-section start -->
  <div class="counter-sections">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="counter-area d-flex justify-content-between">
            <div class="counter-item">
              <div class="counter-icon">
                <img src="assets/images/icons/counter/1.svg" alt="icon">
              </div>
              <div class="counter-content">
                <span class="counter">{{ number_format($registered_account) }}</span>
                <span class="caption">Registered Accounts</span>
              </div>
            </div><!-- counter-item end -->
            <div class="counter-item">
              <div class="counter-icon">
                <img src="assets/images/icons/counter/2.svg" alt="icon">
              </div>
              <div class="counter-content">
                <span>$</span>
                <span class="counter">{{ number_format($invested_amoumt,2) }}</span>
                <span class="caption">Invested with us</span>
              </div>
            </div><!-- counter-item end -->
            <div class="counter-item">
              <div class="counter-icon">
                <img src="assets/images/icons/counter/3.svg" alt="icon">
              </div>
              <div class="counter-content">
                <span>$</span>
                <span class="counter">{{ number_format($average_amoumt,2) }}</span>
                <span class="caption">Average Investment</span>
              </div>
            </div><!-- counter-item end -->
          </div>
        </div>
        </div>
        <div class="col-lg-12 mt-5">
            <h3 class="text-center"><strong>Our AI. (Artificial Intelligence) Trading Program has been online for : <span class="section-subtitle" style="font-size:29px;">{{ $aibot_dates }}</span> <span style="font-size:28px; color: #ff5500;">Days</span></strong></h3>
        </div>
      </div>
    </div>
  </div>
  <!-- counter-section end -->

  <!-- choose-us-section start -->
  <section class="choose-us-section pt-120 pb-120 bg_img" data-background="assets/images/elements/choose-us-bg-shape.png">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="section-header text-center">
            <span class="section-subtitle">Boost your Money</span>
            <h2 class="section-title">Why Should you Choose Us</h2>
            <p>Our service gives you better results and savings, as per your requirement and you can manage your investments from anywhere either from home or workplace, any time.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-lg-12 p-0">
          <div class="choose-us-slider owl-carousel">
              <div class="choose-item text-center">
                <div class="choose-thumb">
                  <img src="assets/images/choose-us/1.png" alt="image">
                </div>
                <div class="choose-content">
                  <h3 class="title">Fast Profit </h3>
                  <p>We're talking about ways you can make money fast.Invest money and get reward, bonus and profit</p><br>
                  <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div><!-- choose-item end -->
              <div class="choose-item text-center">
                <div class="choose-thumb">
                  <img src="assets/images/choose-us/3.png" alt="image">
                </div>
                <div class="choose-content">
                  <h3 class="title">Dedicated Server</h3>
                  <p>Dedicated server hosting with 100% guaranteed network uptime.There's no sharing of CPU time, RAM or bandwidth</p>
                  <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div><!-- choose-item end -->
              <div class="choose-item text-center">
                <div class="choose-thumb">
                  <img src="assets/images/choose-us/4.png" alt="image">
                </div>
                <div class="choose-content">
                  <h3 class="title">DDoS Protection</h3>
                  <p>To protect your resources from modern DDoS attacks is through a multi-layer deployment of purpose-built DDoS mitigation </p>
                  <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div><!-- choose-item end -->
              <div class="choose-item text-center">
                <div class="choose-thumb">
                  <img src="assets/images/choose-us/5.png" alt="image">
                </div>
                <div class="choose-content">
                  <h3 class="title">24/7 Support</h3>
                  <p>Our Technical Support team is available for any questions.Our  multilingual 24/7 support allows to keep in touch.</p>
                  <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="fa fa-long-arrow-right"></i></a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- choose-us-section end -->

  <!-- features-section start -->
  <section class="features-section pt-120 pb-120 section-md-bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="section-header text-center">
            <span class="section-subtitle">Our Amazing Features</span>
            <h2 class="section-title">Investing For Everyone</h2>
            <p>We are a worldwide investment company who are committed to the principle of revenue maximization and reduction of the financial risks with investing.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-4">
          <div class="feature-thumb anim-bounce">
            <img src="assets/images/elements/features.png" alt="image">
          </div>
        </div>
        <div class="col-xl-4 offset-md-1 feature-item-wrapper">
          <div class="feature-item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.3s">
            <div class="icon">
              <div class="icon-inner">
                <img src="assets/images/icons/investment/1.svg" alt="icon">
              </div>
            </div>
            <div class="content">
              <h3 class="title">Sign up in minutes</h3>
              <p>Open an investment account in minutes and get started with as little as $50.</p>
              <a href="{{ url('public/login') }}">get strated</a>
            </div>
          </div><!-- feature-item end -->
          <div class="feature-item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
            <div class="icon">
              <div class="icon-inner">
                <img src="assets/images/icons/investment/2.svg" alt="icon">
              </div>
            </div>
            <div class="content">
              <h3 class="title">Investing Made Easy</h3>
              <p>Choose from three simple starting option - cautious , balanced & adventurous.We’ll take care of the rest!</p>
              <a href="{{ url('public/login') }}">read more</a>
            </div>
          </div><!-- feature-item end -->
          <div class="feature-item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.7s">
            <div class="icon">
              <div class="icon-inner">
                <img src="assets/images/icons/investment/3.svg" alt="icon">
              </div>
            </div>
            <div class="content">
              <h3 class="title">Build Your Porfolio</h3>
              <p>We’ll help you pick an investment strategy that reflects your interests,beliefs and goals.</p>
              <a href="{{ url('public/login') }}">explore our investing </a>
            </div>
          </div><!-- feature-item end -->
        </div>
      </div>
    </div>
  </section>
  <!-- features-section end -->


  <!-- offer-section start -->
  <section class="offer-section pt-120 pb-120 bg_img" data-background="assets/images/offer-bg.png">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="section-header text-center wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.5s">
            <span class="section-subtitle">Our mission is to help our User</span>
            <h2 class="section-title">To Maximize Money</h2>
            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="offer-slider owl-carousel">
            <div class="offer-item">
              <div class="icon">
                <img src="assets/images/icons/offer/1.svg" alt="icon">
              </div>
              <div class="content">
                <h3 class="title">smart deposit</h3>
                <p>Best way t o put your idle money to work.</p>
                <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="icofont-long-arrow-right"></i></a>
              </div>
            </div><!-- offer-item end -->
            <div class="offer-item">
              <div class="icon">
                <img src="assets/images/icons/offer/2.svg" alt="icon">
              </div>
              <div class="content">
                <h3 class="title">One - Tap Invest</h3>
                <p>Invest without net baning/debit card.</p>
                <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="icofont-long-arrow-right"></i></a>
              </div>
            </div><!-- offer-item end -->
            <div class="offer-item">
              <div class="icon">
                <img src="assets/images/icons/offer/3.svg" alt="icon">
              </div>
              <div class="content">
                <h3 class="title">invest & saving</h3>
                <p>Grow your saving by investing as little as $50</p>
                <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="icofont-long-arrow-right"></i></a>
              </div>
            </div><!-- offer-item end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- offer-section end -->

  <!-- calculate-profit-section start -->
  <section id="calc" class="calculate-profit-section pt-120 pb-120">
    <div class="bg_img" data-background="assets/images/invest-plan.jpg"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="section-header text-center text-white">
            <span class="section-subtitle">Calculate the amazing profits</span>
            <h2 class="section-title">You Can Earn</h2>
            <p>Find out what the returns on your current investments will be valued at, in the future. All our issuers have obligation to pay dividends for the first-year regardless of their financial situation that your investments are 100% secured. Calculate your profit from a share using our calculator:</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="calculate-area wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.5s">
            <ul class="nav nav-tabs justify-content-around" id="calculatorTab" role="tablist">
              <li>
                <div class="icon"><img src="assets/images/icons/invest-calculate/1.svg" alt="icon-image"></div>
                <h5 class="package-name">Basic Plan</h5>
                <span class="percentage">25% a month average over 4 months.</span>
              </li>
            </ul>
            <div class="tab-content" id="calculatorTabContent">
              <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                <div class="invest-amount-area text-center">
                  <h4 class="title">Invest Amount</h4>
                  <div class="main-amount">
                    <input type="text" class="calculator-invest" id="basic-amount" readonly>
                  </div>
                  <div id="slider-range-min-one" class="invest-range-slider"></div>
                </div><!-- invest-amount-area end -->
                <div class="plan-amount-calculate">
                  <div class="item">
                    <span class="caption">Basic plan</span>
                    <span class="details">Minimum Deposit $50</span>
                  </div>
                  <div class="item">
                    <span class="profit-amount" id="daily_fee">$12.6</span>
                    <span class="profit-details">Daily Profit</span>
                  </div>
                  <div class="item">
                    <span class="profit-amount" id="monthly_fee">$12.6</span>
                    <span class="profit-details">per month</span>
                  </div>
                  <div class="item">
                    <a href="{{ url('public/login') }}" class="invest-btn btn-round">invest now</a>
                  </div>
                </div><!-- plan-amount-calculate end -->
              </div>
              <div class="tab-pane fade" id="satandard" role="tabpanel" aria-labelledby="satandard-tab">
                <div class="invest-amount-area text-center">
                  <h4 class="title">Invest Amount</h4>
                  <div class="main-amount">
                    <input type="text" class="calculator-invest" id="satandard-amount" readonly>
                  </div>
                  <div id="slider-range-min-two" class="invest-range-slider"></div>
                </div><!-- invest-amount-area end -->
                <div class="plan-amount-calculate">
                  <div class="item">
                    <span class="caption">satandard plan</span>
                    <span class="details">Minimum Deposit $50</span>
                  </div>
                  <div class="item">
                    <span class="profit-amount">$12.67</span>
                    <span class="profit-details">Daily Profit</span>
                  </div>
                  <div class="item">
                    <span class="profit-amount">$12.67</span>
                    <span class="profit-details">per month</span>
                  </div>
                  <div class="item">
                    <a href="{{ url('public/login') }}" class="invest-btn btn-round">invest now</a>
                  </div>
                </div><!-- plan-amount-calculate end -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- calculate-profit-section end -->

  <!-- deposit-withdraw-section start -->
  <section class="deposit-withdraw-section pt-120 pb-120 section-md-bg">
    <div class="circle-object"><img src="assets/images/elements/deposit-circle-shape.png" alt="image"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="section-header text-center">
            <span class="section-subtitle">Convenient money</span>
            <h2 class="section-title">Deposit & Withdrawal</h2>
            <p>Depositing or withdrawing money is simple. We support several payment methods, which depend on what country your payment account is located in.</p>
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="dep-wth-option-area wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.5s">
            <span class="circle one"></span>
            <span class="circle two"></span>
            <span class="circle three"></span>
            <span class="circle four"></span>
            <a href="#0" class="card-item">
              <span class="icon"><img src="assets/images/icons/payment-option/card.svg" alt="image"></span>
              <span class="caption">Credit Card</span>
            </a><!-- card-item end -->
            <a href="#0" class="card-item">
              <span class="icon"><img src="assets/images/icons/payment-option/paypal.svg" alt="image"></span>
              <span class="caption">Credit Card</span>
            </a><!-- card-item end -->
            <a href="#0" class="card-item">
              <span class="icon"><img src="assets/images/icons/payment-option/bitcoin.svg" alt="image"></span>
              <span class="caption">Credit Card</span>
            </a><!-- card-item end -->
            <a href="#0" class="card-item">
              <span class="icon"><img src="assets/images/icons/payment-option/litecoin.svg" alt="image"></span>
              <span class="caption">Credit Card</span>
            </a><!-- card-item end -->
            <a href="#0" class="card-item">
              <span class="icon"><img src="assets/images/icons/payment-option/ethereum.svg" alt="image"></span>
              <span class="caption">Credit Card</span>
            </a><!-- card-item end -->
            <a href="#0" class="card-item">
              <span class="icon"><img src="assets/images/icons/payment-option/ripple.svg" alt="image"></span>
              <span class="caption">Credit Card</span>
            </a><!-- card-item end -->
          </div>
        </div>
        <div class="col-lg-6">
          <div class="feature-item">
            <div class="icon">
              <div class="icon-inner">
                <img src="assets/images/icons/payment-option/ft1.svg" alt="icon">
              </div>
            </div>
            <div class="content">
              <h3 class="title">No Limits</h3>
              <p>Unlimited maximum withdrawal amount</p>
            </div>
          </div><!-- feature-item end -->
          <div class="feature-item">
            <div class="icon">
              <div class="icon-inner">
                <img src="assets/images/icons/payment-option/ft2.svg" alt="icon">
              </div>
            </div>
            <div class="content">
              <h3 class="title">Withdrawal in 14 Days</h3>
              <p>Deposit – instantaneous</p>
            </div>
          </div><!-- feature-item end -->
        </div>
      </div>
    </div>
  </section>
  <!-- deposit-withdraw-section end -->

  <!-- community-section start -->
  <section class="community-section bg_img pt-120" data-background="assets/images/community-bg.png">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="section-header text-center text-white wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.5s">
            <span class="section-subtitle">We support</span>
            <h2 class="section-title">Cryptocurrency Community</h2>
            <p>Access a world of dynamic investment opportunities, buy into businesses you believe in, and share in their success. You may make additional deposits at any time. All our payments are instant payments.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="community-wrapper">
            <div class="row">
              <div class="col-lg-7">
                <div class="community-item">
                  <div class="icon">
                    <img src="assets/images/icons/community/1.svg" alt="image">
                  </div>
                  <div class="content">
                    <h3 class="title">Simplicity</h3>
                    <p>We’re eliminating complex user experiences.</p>
                    <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="icofont-long-arrow-right"></i></a>
                  </div>
                </div><!-- community-item end -->
                <div class="community-item">
                  <div class="icon">
                    <img src="assets/images/icons/community/2.svg" alt="image">
                  </div>
                  <div class="content">
                    <h3 class="title">security</h3>
                    <p>Enhanced security features like multi-factor </p>
                    <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="icofont-long-arrow-right"></i></a>
                  </div>
                </div><!-- community-item end -->
                <div class="community-item">
                  <div class="icon">
                    <img src="assets/images/icons/community/3.svg" alt="image">
                  </div>
                  <div class="content">
                    <h3 class="title">support</h3>
                    <p>Get all the support you need for your Investment</p>
                    <a href="{{ url('public/login') }}" class="read-more-btn">read more<i class="icofont-long-arrow-right"></i></a>
                  </div>
                </div><!-- community-item end -->
              </div>
              <div class="col-lg-5">
                <div class="user-wrapper">
                  <div class="icon">
                    <img src="assets/images/icons/community/user-icon.svg" alt="image">
                  </div>
                  <span class="caption"><?php echo $registered_account; ?> Users</span>
                  <div class="users-area">
                    <span class="user-img"><img src="assets/images/users/s1.png" alt="image"></span>
                    <span class="user-img"><img src="assets/images/users/s2.png" alt="image"></span>
                    <span class="user-img"><img src="assets/images/users/s3.png" alt="image"></span>
                    <span class="user-img"><img src="assets/images/users/s4.png" alt="image"></span>
                    <span class="user-img"><img src="assets/images/users/s5.png" alt="image"></span>
                    <span class="user-img"><img src="assets/images/users/s6.png" alt="image"></span>
                    <span class="user-img"><img src="assets/images/users/s7.png" alt="image"></span>
                  </div>
                </div>
                <div class="btn-area text-center">
                  <a href="{{ url('public/login') }}" class="btn btn-secondary">join us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </section>
  <!-- community-section end -->

  <!-- latest-transaction-section start -->
  <section id="transaction" class="latest-transaction-section pt-120 pb-120">
      <div ></div>
    <div class="elemets-bg" data-paroller-factor="-0.2" data-paroller-type="foreground" data-paroller-direction="vertical"><img src="assets/images/withdraw-bg.png" alt=""></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="section-header text-center">
            <span class="section-subtitle">Latest Transaction</span>
            <h2 class="section-title">Transactions </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <h5 class="text-center"><strong>Last 10 DEPOSITS</strong></h5>
          <div class="tab-content" id="transactionTabContent">
            <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
              <div class="deposit-table-area">
                <table>
                  <thead>
                    <tr>
                      <th>name</th>
                      <th>amount</th>
                      <th>date</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_deposit">
                    @foreach($deposit_list as $tran)
                    <tr>
                      <td>{{ $tran->client->firstname . ' ' . $tran->client->lastname }}</td>
                      <td>$ {{ number_format($tran->amount, 2) }}</td>
                      <td>{{ $tran->created_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div class="btn-area text-center">
            
          </div>
        </div>
        <div class="col-lg-6">
          <h5 class="text-center"><strong>Last 10 WITHDRAWALS</strong></h5>
          <div class="tab-content" id="transactionTabContent">
            <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
              <div class="withdraw-table-area">
                <table>
                  <thead>
                    <tr>
                      <th>name</th>
                      <th>amount</th>
                      <th>date</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_withdraw">
                    @foreach($withdraw_list as $tran)
                    <tr>
                      <td>{{ $tran->client->firstname . ' ' . $tran->client->lastname }}</td>
                      <td>$ {{ number_format($tran->amount, 2) }}</td>
                      <td>{{ $tran->created_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div class="btn-area text-center">
            
          </div>
        </div>
        
        <div class="col-lg-12">
          <h5 class="text-center">Here you can see trade opportunities we have found with our AI. ( Artificial Intelligence )</h5>
          <h5 class="text-center">This data is delayed by an hour to stop people from being able to use our data to trade for themselves. </h5>
          <br>
          <h5 class="text-center">We have over 20 dedicated Servers around the world which allows us to analyze the markets in real-time. Ensuring we only enter into profitable trades.</h5>
          <br>
          <div class="tab-content" id="">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="daily-tab">
              <div class="trading-table-area">
                <table>
                  <thead>
                    <tr>
                      <th>Market</th>
                      <th>Type</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody id="trades"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- latest-transaction-section end -->

  <!-- affiliate-features-section start -->
  <section id="affprog" class="affiliate-features-section pt-120 pb-120">
    <div class="shape"><img src="assets/images/elements/affiliate-shape.png" alt="image"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-6">
          <div class="affiliate-features-content text-xl-left text-center">
            <div class="section-header">
              <span class="section-subtitle">Earn The Big Money</span>
              <h2 class="section-title">Affiliate Program</h2>
              <p>Our affiliate program can increase your income by receiving a percentage from the profits made by your referrals into your own account. </p>
            </div>
            <p>Invite other users (for example, your friends, co-workers, etc.) to join the project. After registration they will be your referrals; and every time they receive a profit you will be rewarded a 5% commission on it.</p>
            
            <p>We are not an MLM. The referral commission is only on direct referrals.</p>
            
            <a href="{{ url('public/login') }}" class="btn btn-primary btn-hover text-small">read more</a>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="row mb-none-30">
            <div class="col-xl-6 col-lg-4 col-md-6">
              <div class="affiliate-features-item text-center mb-30">
                <div class="icon"><img src="assets/images/icons/affiliate-features/1.svg" alt="image"></div>
                <span class="subtitle">Enjoy unlimited</span>
                <h3 class="title">Commissions</h3>
                <p>The more User you refer, the more commissions we’ll pay you. Plain and simple.</p>
              </div>
            </div><!-- affiliate-features-item end -->
            <div class="col-xl-6 col-lg-4 col-md-6">
              <div class="affiliate-features-item text-center mb-30">
                <div class="icon"><img src="assets/images/icons/affiliate-features/2.svg" alt="image"></div>
                <span class="subtitle">Extra Bonus and</span>
                <h3 class="title">Promotions</h3>
                <p>Boost your monthly earnings with additional promotional opportunities.</p>
              </div>
            </div><!-- affiliate-features-item end -->
            <div class="col-xl-6 col-lg-4 col-md-6">
              <div class="affiliate-features-item text-center mb-30">
                <div class="icon"><img src="assets/images/icons/affiliate-features/3.svg" alt="image"></div>
                <span class="subtitle">Get top notch</span>
                <h3 class="title">Support</h3>
                <p>Maximize your earning potential with our popular amazing support center.</p>
              </div>
            </div><!-- affiliate-features-item end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- affiliate-features-section end -->
  <section id="faq" class="section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-header section-header--animated section-header--center section-header--medium-margin text-center">
                    <span class="section-subtitle">FAQ</span>
                    <h2>Frequently asked questions</h2> </div>
            </div>
        </div>
        <div class="row margin0">
            
            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true" style="width: 100%;">
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne1">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                            <h5 class="mb-0">
                              Is there a guaranteed minimum return?
                            </h5> </a>
                    </div>
                    <div id="collapseOne1" class="collapse" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                        <div class="card-body">Although historically we are achieving a daily return of between 0.75 and 1.0%, we cannot guarantee a minimum return, since the profitability obtained depends on a multitude of variables. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne2">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne2" aria-expanded="false" aria-controls="collapseOne2">
                            <h5 class="mb-0">
                              How can I participate?
                            </h5> </a>
                    </div>
                    <div id="collapseOne2" class="collapse" role="tabpanel" aria-labelledby="headingOne2" data-parent="#accordionEx">
                        <div class="card-body">To participate you just have to open an account on the platform and make a contribution of at least $ 50 up to a maximum of $ 100,000. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne3">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne3" aria-expanded="false" aria-controls="collapseOne3">
                            <h5 class="mb-0">
                              What forms of payment exist to make contributions?
                            </h5> </a>
                    </div>
                    <div id="collapseOne3" class="collapse" role="tabpanel" aria-labelledby="headingOne3" data-parent="#accordionEx">
                        <div class="card-body">Contributions can be made directly with BTCs by sending the amount to the wallet that appears when you complete the process. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne4">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                            <h5 class="mb-0">
                              How can I make contributions in Bitcoins?
                            </h5> </a>
                    </div>
                    <div id="collapseOne4" class="collapse" role="tabpanel" aria-labelledby="headingOne4" data-parent="#accordionEx">
                        <div class="card-body">To make payments in Bitcoins it is necessary to have Bitcoins in a wallet. If you don't know how Bitcoins work you can find out <a href="https://bitcoin.org/en/getting-started" target="_blank">here</a> </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne5">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne5" aria-expanded="false" aria-controls="collapseOne5">
                            <h5 class="mb-0">
                              Can I withdraw my contribution?
                            </h5> </a>
                    </div>
                    <div id="collapseOne5" class="collapse" role="tabpanel" aria-labelledby="headingOne5" data-parent="#accordionEx">
                        <div class="card-body">Yes, Contribution can be withdrawn after 14 days. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne6">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
                            <h5 class="mb-0">
                              Is this not just another scam?
                            </h5> </a>
                    </div>
                    <div id="collapseOne6" class="collapse" role="tabpanel" aria-labelledby="headingOne6" data-parent="#accordionEx">
                        <div class="card-body">Unfortunately, it is true that more and more scams are emerging with the cryptocurrency boom. The difference between a scam and a real project is the information offered, the generation of value and the proven facts. Our Investing Platform is integrated with Blockchain, which means that the money is just one click away from each person's wallet and therefore has to be within the system. The fact that at any time, any person can make a balance withdrawal implies that the money deposited has to be available in the platform wallet in order to be transferred. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne7">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne7" aria-expanded="false" aria-controls="collapseOne7">
                            <h5 class="mb-0">
                              How are the returns received?
                            </h5> </a>
                    </div>
                    <div id="collapseOne7" class="collapse" role="tabpanel" aria-labelledby="headingOne7" data-parent="#accordionEx">
                        <div class="card-body">Returns are paid daily in dollars in the account of each investor. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne8">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne8" aria-expanded="false" aria-controls="collapseOne8">
                            <h5 class="mb-0">
                              Do you pay returns every day?
                            </h5> </a>
                    </div>
                    <div id="collapseOne8" class="collapse" role="tabpanel" aria-labelledby="headingOne8" data-parent="#accordionEx">
                        <div class="card-body">Returns are calculated and distributed every day. The entire team of professionals behind our Investing Platform have spent many hours developing the system and all our efforts are aimed at optimizing profitability. </div>
                       </div>
                    </div>
                    <div class="card">
                    <div class="card-header" role="tab" id="headingOne10">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne10" aria-expanded="false" aria-controls="collapseOne10">
                            <h5 class="mb-0">
                              When will my participation start to generate profitability?
                            </h5> </a>
                    </div>
                    <div id="collapseOne10" class="collapse" role="tabpanel" aria-labelledby="headingOne10" data-parent="#accordionEx">
                        <div class="card-body">New deposits become active on the following Sunday.</div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne11">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne11" aria-expanded="false" aria-controls="collapseOne11">
                            <h5 class="mb-0">
                              Is there a minimum amount to withdraw my returns?
                            </h5> </a>
                    </div>
                    <div id="collapseOne11" class="collapse" role="tabpanel" aria-labelledby="headingOne11" data-parent="#accordionEx">
                        <div class="card-body">Yes, in order to withdraw money it is essential to have a minimum of $ 50 accumulated in your account balance. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne12">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne12" aria-expanded="false" aria-controls="collapseOne12">
                            <h5 class="mb-0">
                              When I make a withdrawal from my account, How do I receive it?
                            </h5> </a>
                    </div>
                    <div id="collapseOne12" class="collapse" role="tabpanel" aria-labelledby="headingOne12" data-parent="#accordionEx">
                        <div class="card-body">Withdrawals are paid in Bitcoin. With Bitcoin the exchange rate existing between the dollar and Bitcoin at the time of the withdrawal is used. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne13">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne13" aria-expanded="false" aria-controls="collapseOne13">
                            <h5 class="mb-0">
                              Is it a safe investment?
                            </h5> </a>
                    </div>
                    <div id="collapseOne13" class="collapse" role="tabpanel" aria-labelledby="headingOne13" data-parent="#accordionEx">
                        <div class="card-body">We have been researching and developing our platform for a long time and although it is true that so far our results have been positive, operating in the crypto-assets market implies a high level of risk. Although the team of specialists and professionals behind Our Investing Platform works daily to obtain the best results, crypto-assets are always high-risk markets. Whenever crypto-assets are acquired, we must be aware of all the associated risks and bear in mind that high returns always imply taking greater risks and of course if you have any doubts you should seek advice from an independent financial advisor. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne14">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne14" aria-expanded="false" aria-controls="collapseOne14">
                            <h5 class="mb-0">
                              By participating in Our Investing Platform, am I buying cryptocurrencies?
                            </h5> </a>
                    </div>
                    <div id="collapseOne14" class="collapse" role="tabpanel" aria-labelledby="headingOne14" data-parent="#accordionEx">
                        <div class="card-body">No, when you participate in Our Investing Platform you are contributing capital to a system that invests in different crypto assets, but you are not acquiring cryptocurrencies as such. You acquire a right to collect the daily return obtained by your contribution. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne15">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne15" aria-expanded="false" aria-controls="collapseOne15">
                            <h5 class="mb-0">
                              What does Our Investing Platform invest in to obtain its profitability?
                            </h5> </a>
                    </div>
                    <div id="collapseOne15" class="collapse" role="tabpanel" aria-labelledby="headingOne15" data-parent="#accordionEx">
                        <div class="card-body">We continuously monitor and analyze the evolution of thousands of crypto-assets and their exchange rate in different currencies and through the use of advanced algorithms we detect real-time buying/selling opportunities. Depending on each moment we can operate in several crypto-assets simultaneously or in only a few or none. The value of our system is in knowing what crypto-assets, what currencies and at what time you have to buy or sell and that information, of course, we cannot make public. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne16">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne16" aria-expanded="false" aria-controls="collapseOne16">
                            <h5 class="mb-0">
                              Do you invest in Bitcoin?
                            </h5> </a>
                    </div>
                    <div id="collapseOne16" class="collapse" role="tabpanel" aria-labelledby="headingOne16" data-parent="#accordionEx">
                        <div class="card-body">Bitcoin is one of thousands of crypto-assets whose evolution we track and analyze and as for the rest of crypto-assets, depending on each moment we can carry out operations with them. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne17">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne17" aria-expanded="false" aria-controls="collapseOne17">
                            <h5 class="mb-0">
                              Does Our Investing Platform use Blockchain technology?
                            </h5> </a>
                    </div>
                    <div id="collapseOne17" class="collapse" role="tabpanel" aria-labelledby="headingOne17" data-parent="#accordionEx">
                        <div class="card-body">Yes, the platform is integrated with Blockchain. This facilitates automated payments and withdrawal, this is done instantly. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne18">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne18" aria-expanded="false" aria-controls="collapseOne18">
                            <h5 class="mb-0">
                              Can I recommend it to my friends?
                            </h5> </a>
                    </div>
                    <div id="collapseOne18" class="collapse" role="tabpanel" aria-labelledby="headingOne18" data-parent="#accordionEx">
                        <div class="card-body">Yes of course. Furthermore, there is a referral program that offers advantages for the person making the recommendation. </p>
                            <p> 1) In order to qualify for referrals, you must have a minimum balance in your account of $5,000 </p>
                            <p>2) Commission Structure: <strong>A 5% commission is paid to you from every profit your referee makes.</strong> </p>
                            <p> 3) In order to qualify for commission the new member must fund there account with a minimum of $1000 </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne19">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne19" aria-expanded="false" aria-controls="collapseOne19">
                            <h5 class="mb-0">
                              Can I sign up on the Investing Platform without being referred or recommended?
                            </h5> </a>
                    </div>
                    <div id="collapseOne19" class="collapse" role="tabpanel" aria-labelledby="headingOne19" data-parent="#accordionEx">
                        <div class="card-body">Yes. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne20">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne20" aria-expanded="false" aria-controls="collapseOne20">
                            <h5 class="mb-0">
                              Can I make multiple contributions to my account?
                            </h5> </a>
                    </div>
                    <div id="collapseOne20" class="collapse" role="tabpanel" aria-labelledby="headingOne20" data-parent="#accordionEx">
                        <div class="card-body">Yes, you can contribute as many times as you want. The only limit is that the minimum amount for each contribution is $ 50 and the sum of all contributions made from the same account cannot exceed $ 100,000. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne21">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne21" aria-expanded="false" aria-controls="collapseOne21">
                            <h5 class="mb-0">
                              Is there a referral program?
                            </h5> </a>
                    </div>
                    <div id="collapseOne21" class="collapse" role="tabpanel" aria-labelledby="headingOne21" data-parent="#accordionEx">
                        <div class="card-body">Yes, there is a referral program for people who want to generate a team or network of recommendations. </p>
                            <p> 1) In order to qualify for referrals, you must have a minimum balance in your account of $5,000 </p>
                            <p>2) Commission Structure: <strong>A 5% commission is paid to you from every profit your referee makes.</strong> </p>
                            <p> 3) In order to qualify for commission the new member must fund there account with a minimum of $1000 </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne22">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne22" aria-expanded="false" aria-controls="collapseOne22">
                            <h5 class="mb-0">
                              Do I have to pay tax on the profits obtained?
                            </h5> </a>
                    </div>
                    <div id="collapseOne22" class="collapse" role="tabpanel" aria-labelledby="headingOne22" data-parent="#accordionEx">
                        <div class="card-body">Depending on the country in which you reside, all income obtained must be declared. Our recommendation is that if you have any questions, seek advice from an expert professional and always comply with the tax obligations of the country where you reside. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne23">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne23" aria-expanded="false" aria-controls="collapseOne23">
                            <h5 class="mb-0">
                              What are the management and maintenance costs?
                            </h5> </a>
                    </div>
                    <div id="collapseOne23" class="collapse" role="tabpanel" aria-labelledby="headingOne23" data-parent="#accordionEx">
                        <div class="card-body">To cover the necessary expenses for the operation of the platform, we withdraw 5% of the profits generated, in this way daily when we make the payment of the profitability obtained, 5% is withdrawn to maintain the platform and the remaining 95% is distributed. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne24">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne24" aria-expanded="false" aria-controls="collapseOne24">
                            <h5 class="mb-0">
                              Is any other type of commission charged?
                            </h5> </a>
                    </div>
                    <div id="collapseOne24" class="collapse" role="tabpanel" aria-labelledby="headingOne24" data-parent="#accordionEx">
                        <div class="card-body">No, Our Investing Platform only charges 5% for management and maintenance expenses from the daily profits . When making contributions or withdrawals from your account, a small commission is charged, by the blockchain with transaction fees. </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne25">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne25" aria-expanded="false" aria-controls="collapseOne25">
                            <h5 class="mb-0">
                              Do you have an App for Android or iPhone?
                            </h5> </a>
                    </div>
                    <div id="collapseOne25" class="collapse" role="tabpanel" aria-labelledby="headingOne25" data-parent="#accordionEx">
                        <div class="card-body">No, Our Investing Platform is adapted to access with any mobile device but no specific App for Android or iPhone has been developed. Any App that is advertised from the iPhone or Android stores does not belong to Our Investing Platform and therefore will not allow trading with Our Investing Platform accounts. </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- footer-section start -->
  <footer id="contact" class="footer-section">
    <div class="footer-top bg_img pb-0" data-background="assets/images/footer-bg.png">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-header text-white text-center">
              <span class="section-subtitle"></span>
              <h2 class="section-title">CONTACT US</h2>
              <p>If you have any questions or would like more information, please contact us and our experts will advise you. </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="subscribe-wrapper">
              <span class="icon wow zoomIn" data-wow-duration="0.3s" data-wow-delay="0.5s"><img src="assets/images/icons/subscribe.png" alt="icon"></span>
              <form class="subscribe-form" method="get" action="javascript:;" style="display: block;">
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form__input" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form__input" placeholder="Email">
                </div>
                <div class="form-group">
                    <textarea name="message" id="message" class="form__textarea" placeholder="Message" style="border: none; border-bottom: 1px solid rgb(166, 151, 146); background-color: transparent; margin-right: 50px; color: #ffffff;"></textarea>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" name="captcha" data-sitekey="6LdvAZ4UAAAAALPnBtZGyx9jIw00GZAya1z6qln_"></div>
                </div>
                <div class="inline-block" style="text-align: center;">
                    <button type="submit" id="btn_submit" class="subs-btn">Send<span class="btn-icon"><img src="assets/images/icons/paper-plane.png" alt="icon"></span></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-md-12">
                <p class="copy-right-text text-md-left text-center mb-md-0 mb-3">Copyright © 2018 - 2020.All Rights Reserved By <a href="">25 Percent</a></p>
              </div>
            </div>
          </div>
        </div>
    </div>
  </footer>
  <!-- footer-section end -->

  <!-- scroll-to-top start -->
  <div class="scroll-to-top">
    <span class="scroll-icon">
      <i class="fa fa-rocket"></i>
    </span>
  </div>
  <!-- scroll-to-top end --> 

  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.nice-select.js"></script>
  <script src="assets/js/lightcase.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery-ui.min.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/jquery.waypoints.min.js"></script>
  <script src="assets/js/jquery.countup.min.js"></script>
  <script src="assets/js/jquery.paroller.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.js"></script>
  <script src="assets/js/ccc-streamer-utilities.js"></script>
  <script src="assets/js/stream.js"></script>
  <script src="assets/js/main.js"></script>
  
    <script type="text/javascript">
      $(document).ready(function() {
          $("#btn_submit").on("click", function() 
          {
              if($("#name").val().length == 0 ||
                $("#email").val().length == 0 ||
                $("#message").val().length == 5)
                {
                    alert("Input data correctly");
                    return;
                }
              
              $.ajax({
                type: "GET",
                url: "public/auto/mail",
                data: {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    message: $("#message").val(),
                },
                dataType: 'json',
                success: function (data) {
                    alert("We received your message successfully. We will respond as soon as possible. Thanks for using our platform.");
                    
                    $("#name").val("");
                    $("#email").val("");
                    $("#message").val("");
                }});
          });

          setInterval(function(){ 
            $.ajax({
                type: "GET",
                url: "public/auto/transdata",
                data: {},
                dataType: 'json',
                success: function (data) {
                    for (var i = data.deposit_list.length - 1; i >= 0; i--) {
                      var tr_str = "<tr>";
                      tr_str += "<td>" + data.deposit_list[i].name + "</td>";
                      tr_str += "<td>$ " + data.deposit_list[i].amount + "</td>";
                      tr_str += "<td>" + data.deposit_list[i].date + "</td>";
                      tr_str += "</tr>";
                      $("#tbody_deposit").prepend(tr_str);
                      
                      if($("#tbody_deposit").children().length > 10)
                        $("#tbody_deposit tr:last-child").remove();
                    }

                    for (var i = data.withdraw_list.length - 1; i >= 0; i--) {
                      var tr_str = "<tr>";
                      tr_str += "<td>" + data.withdraw_list[i].name + "</td>";
                      tr_str += "<td>$ " + data.withdraw_list[i].amount + "</td>";
                      tr_str += "<td>" + data.withdraw_list[i].date + "</td>";
                      tr_str += "</tr>";
                      $("#tbody_withdraw").prepend(tr_str);
                      
                      if($("#tbody_withdraw").children().length > 10)
                        $("#tbody_withdraw tr:last-child").remove();
                    }
                }});
          }, 3000);
      });
  </script>
</body>

<!--  -->
</html>