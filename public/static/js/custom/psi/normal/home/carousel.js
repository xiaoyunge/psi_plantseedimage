(function(){
  $(document).ready(function(){
    var style = {
      "height" : "300",
      "float" : "clear"
    };
    // 先隐藏所有的图片轮播图片中的图片
    var totalImgNum;
    var firstImg;
    var currentImgNo;
    var interval = 3000;
    $(".carousel .carousel-image-container li img").css("display", "none").css(style);
    totalImgNum = $(".carousel .carousel-image-container li").length;
    // 验证是否存在指定的active图片作为图片轮播的第一张图片
    if ( $(".carousel .carousel-image-container li.active img").length === 1 ) {
      firstImg = $(".carousel .carousel-image-container li.active img");
      currentImgNo = $(".carousel .carousel-image-container li.active").index ();
      // 确定好轮播中的第一张图片，把它显现出来
      firstImg.css("display", "block");
    } else {
      // 否则，则选择ul列表中第一个li元素中的图像作为第一张图片
      firstImg = $(".carousel .carousel-image-container li").eq(0).find("img");
      currentImgNo = 0;
      firstImg.css("display", "block");
    }
    // 设置每interval秒就调用函数carousel_switch()来切换图片
    setInterval(function(){
      carousel_switch(currentImgNo, totalImgNum);
      // 切换图片后的操作
      // 如果当前图片队列编号是最后一个时
      if (currentImgNo === totalImgNum - 1) {
        currentImgNo = 0;
      } else {
        currentImgNo = currentImgNo + 1;
      }
    }, interval);
  });
  function carousel_switch( currentImgNo, totalImgNum ) {
    if ( currentImgNo === totalImgNum - 1 ) {
      $(".carousel .carousel-image-container li").eq(currentImgNo).find("img").fadeOut("2000").removeClass("active");
      setTimeout(function(){
        $(".carousel .carousel-image-container li").eq(0).find("img").css("display", "block").addClass("active");
      }, 500);
    } else {
      $(".carousel .carousel-image-container li").eq(currentImgNo).find("img").fadeOut("2000").removeClass("active");
      setTimeout(function(){
        $(".carousel .carousel-image-container li").eq(currentImgNo + 1).find("img").css("display", "block").addClass("active");
      }, 500);
    }
  }
})();
