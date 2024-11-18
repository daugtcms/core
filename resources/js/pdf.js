window.setupPdfViewer = function (src) {
    let pdfDocument = null;
    return {
        src: src,
        currentPage: 1,
        canvas: null,
        init() {
            import('pdfjs-dist').then(pdfjs => {
                    pdfjs.GlobalWorkerOptions.workerSrc = '/vendor/daugt/assets/pdf.worker.min.js';
                    pdfjs.getDocument(this.src).promise.then(pdf => {
                        pdfDocument = pdf;
                        this.renderPage();
                        this.canvas = this.$el.querySelector('canvas');
                    });
            });
        },
        renderPage() {
            pdfDocument.getPage(this.currentPage).then(page => {
                const viewport = page.getViewport({scale: 1.5});
                var outputScale = window.devicePixelRatio || 1;

                const context = this.canvas.getContext('2d');

                this.canvas.width = Math.floor(viewport.width * outputScale);
                this.canvas.height = Math.floor(viewport.height * outputScale);

                var transform = outputScale !== 1
                    ? [outputScale, 0, 0, outputScale, 0, 0]
                    : null;

                page.render({
                    canvasContext: context,
                    transform: transform,
                    viewport: viewport,
                });
            });
        },
        nextPage() {
            if(this.currentPage >= pdfDocument.numPages) {
                this.currentPage = 0;
            }
            this.currentPage++;
            this.renderPage();
        },
        previousPage() {
            if(this.currentPage <= 1) {
                this.currentPage = pdfDocument.numPages + 1;
            }
            this.currentPage--;
            this.renderPage();
        }
    }
}
