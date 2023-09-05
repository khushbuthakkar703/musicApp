function drawBar(ctx, upperLeftCornerX, upperLeftCornerY, width, height,color){
    ctx.save();
    ctx.fillStyle=color;
    ctx.fillRect(upperLeftCornerX,upperLeftCornerY,width,height);
    ctx.restore();
}

var Barchart = function(options){
    this.options = options;
    this.canvas = options.canvas;
    this.ctx = this.canvas.getContext("2d");
    this.colors = options.colors;

    this.draw = function(){
        var maxValue = 40;
        var canvasActualHeight = this.canvas.height - this.options.padding * 2;
        //drawing the bars
        var barIndex = 0;
        var barSize = 1.3;

        for (categ in this.options.data){
            var val = this.options.data[categ];
            var barHeight = Math.round( canvasActualHeight * val/maxValue) ;
            // console.log(barHeight, val, maxValue, canvasActualHeight)
            drawBar(
                this.ctx,
                this.options.padding + barIndex * (barSize+0.7),
                (this.canvas.height - (barHeight + this.options.padding))/2,
                barSize,
                barHeight,
                this.colors[barIndex%this.colors.length]
            );

            barIndex++;
        }

    }
}
