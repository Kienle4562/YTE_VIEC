var vnwTracking = (function() {
  var options = null;

  var runHomeTracking = function (options) {
    this.options = options;
    bindHomeProductsClick();
  };

  var runHomeTracking = function (options) {
    this.options = options;
    bindHomeProductsClick();
  };

  var runTrackingBannersOnSearch = function (options) {
    this.options = options;
    bindBannersClickOnSearchPage();
  };

  var runTrackingJobSuggestionSideBar = function (options) {
      this.options = options;
      bindClickOnJobDetailSideBar();
  };

  var bindHomeProductsClick = function () {
    $('#ads_TOP_COMPANIES_HORISONTAL').on('click', '.single-bnr', {dataGenerator: vipLogoData}, callWriteLogServiceOnClick);
    $('.hero-carousel').on('click', '.hot-corner', {dataGenerator: heroBannerData}, callWriteLogServiceOnClick);
    $('.home__top-management-jobs .tmj-content').on('click', 'a', {dataGenerator: jobChannelData('TopManagementJobs')}, callWriteLogServiceOnClick);
    $('.home__top-management-jobs .it-content').on('click', 'a', {dataGenerator: jobChannelData('ITJobs')}, callWriteLogServiceOnClick);
    $('.home__top-management-jobs .intern-content').on('click', 'a', {dataGenerator: jobChannelData('InternJobs')}, callWriteLogServiceOnClick);
    $('#topJobs .hot-job').on('click', 'a', {dataGenerator: hotJobData}, callWriteLogServiceOnClick);
    $('#topJobs .job').not('.hot-job').on('click', 'a', {dataGenerator: topJobData}, callWriteLogServiceOnClick);
    $('#recommendedJobs').on('click', '.job a', {dataGenerator: recoJobData}, callWriteLogServiceOnClick);
    $('.home__other-employers').on('click', 'a', {dataGenerator: featureEmpData}, callWriteLogServiceOnClick);
    $('.home__company-spotlight .company-list').on('click', '.info-container a', {dataGenerator: companySpotlightData}, callWriteLogServiceOnClick);
    $('.home__hr-insider').on('click', '.article-contain a', {dataGenerator: hrArticleData}, callWriteLogServiceOnClick);
    $('.home__square-bnr').on('click', 'a', {dataGenerator: squareBannerData}, callWriteLogServiceOnClick);
  };

  var bindBannersClickOnSearchPage = function () {
      $('#ads-focus-on-banner').on('click', '.banner-content__cta-btn a', {dataGenerator: focusOnData}, callWriteLogServiceOnClick);
      $('#ads_LEFT').on('click', '.ads_LEFT_FIRST a', {dataGenerator: marketingBannerData('First')}, callWriteLogServiceOnClick);
      $('#ads_LEFT').on('click', '.ads_LEFT_SECOND a', {dataGenerator: marketingBannerData('Second')}, callWriteLogServiceOnClick);
      $('#ads_RIGHT_ADV_JS_SEARCHRESULT').on('click', 'a', {dataGenerator: saleBannerData}, callWriteLogServiceOnClick);
      $('#main-job-list').on('click', '.middle-banner a', {dataGenerator: midBannerData}, callWriteLogServiceOnClick);
      $('#ads_BOTTOM').on('click', 'a', {dataGenerator: bottomBannerData}, callWriteLogServiceOnClick);

  };

  var bindClickOnJobDetailSideBar = function () {
      $('#loving-jobs').on('click', 'a', {dataGenerator: jobRecommendSideBarJD}, callWriteLogServiceOnClick);
  };

  var callWriteLogServiceOnClick = function (event) {
    var element = event.currentTarget;
    var dataGeneratorHandler = event.data.dataGenerator;
    var trackingOptions = vnwTracking.options;

    var logData = dataGeneratorHandler();
    if (logData.data.zone == 'Article') {
      logData.data.zone += findArticleOrder(element);
    }
    if (logData.data.zone == 'JobRecommendSideBarJD') {
      logData.data.jobId = findJobId(element);
    }

    logData.meta = {
      url: element.href
    };
    logData.type = 'click';
    logData.data = getCommonTrackingData(logData.data, trackingOptions);

    $.ajax({
      method: 'POST',
      url : trackingOptions.url,
      data: logData,
      dataType: 'json',
      timeout: 300
    })
  };

  var vipLogoData = function () {
    return {
      data: {
        zone: "Viplogo"
      }
    };
  };

  var heroBannerData = function () {
    return {
      data: {
        zone: "HeroBanner"
      }
    };
  };

  var jobChannelData = function (channelName) {
    return function () {
      return {
        data: {
          zone: channelName
        }
      };
    }
  };

  var hotJobData = function () {
    return {
      data: {
        zone: "HotJob"
      }
    };
  };

  var topJobData = function () {
    return {
      data: {
        zone: "TopJob"
      }
    };
  };

  var recoJobData = function () {
    return {
      data: {
        zone: "TopJobReco"
      }
    };
  };

  var featureEmpData = function () {
    return {
      data: {
        zone: "FeatureLogo"
      }
    };
  };

  var companySpotlightData = function () {
    return {
      data: {
        zone: "Companyspotlight"
      }
    };
  };

  var hrArticleData = function () {
    return {
      data: {
        zone: 'Article'
      }
    };
  };

  var squareBannerData = function () {
    return {
      data: {
        zone: 'HomeSquare'
      }
    };
  };

  var focusOnData = function () {
    return {
      data: {
        zone: 'SideBannerFocusOn'
      }
    }
  };

  var marketingBannerData = function (number) {
    return function () {
      return {
        data: {
          zone: 'SideBannerMarketing' + number
        }
      }
    };
  };

  var saleBannerData = function () {
    return {
      data: {
        zone: 'SideBannerSales'
      }
    }
  };

  var midBannerData = function () {
    return {
      data: {
        zone: 'MidBanner'
      }
    }
  };

  var bottomBannerData = function () {
    return {
      data: {
        zone: 'BottomBanner'
      }
    }
  };

  var jobRecommendSideBarJD = function () {
      return {
          data: {
              zone: 'JobRecommendSideBarJD'
          }
      }
  };

  var findArticleOrder = function (el) {
    var slickEl = $(el).closest('.slick-slide');
    return slickEl.data('slick-index') + 1;
  };

  var findJobId = function (el) {
      var jobEl = $(el);
      return jobEl.data('item-id');
  };

  var getCommonTrackingData = function (data, options) {
    data['userID'] = options.userId;
    data['utm_DeviceType'] = options.isMobile ? 'Mobile' : 'Desktop';
    return data;
  };

  return {
    runHomeTracking: runHomeTracking,
    runTrackingBannersOnSearch: runTrackingBannersOnSearch,
    runTrackingJobSuggestionSideBar : runTrackingJobSuggestionSideBar
  };
})();