<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Print Files</h4>
        </div>
        <div class="modal-body">
            <center>
                {{-- <img class="pic" src="#" id="printimg" alt="" style="backgound-color:white;border:1px solid black"> --}}
                <section class="slider-wrapper">
                    <button class="slide-arrow" id="slide-arrow-prev">
                        &#8249;
                    </button>
                    <button class="slide-arrow" id="slide-arrow-next">
                        &#8250;
                    </button>
                    <ul class="slides-container" id="slides-container">
                        @foreach (Storage::disk('files')->files($file) as $fileName)
                            <li class="slide">
                                <img src="{{ asset('files/' . $fileName) }}" alt="" width="80%"
                                    style="border:1px solid black">
                            </li>
                        @endforeach
                    </ul>
                    <div class="pages-container">page
                        <input id="page" step="1" oninput="goToPage(this.value)" value="1"
                            type="number" min="1" max="{{ $pdf->getNumberOfPages() }}" style="width:5rem">
                        <span> of </span>
                        <b>{{ $pdf->getNumberOfPages() }}</b>
                    </div>
                </section>
            </center>

            <div class="row cont">
                <label class="col-sm-3 control-label"> Print Type </label>
                <div class="col-sm-9">
                    <label class="checkbox-inline">
                        <input type="radio" name="type" class="compute" value="colored" checked>
                        Colored
                    </label>
                </div>
            </div>

            <div class="row cont">
                <label class="col-sm-3 control-label"> Paper Size </label>
                <div class="col-sm-9">
                    <select class="form-control compute" name="size" id="papersize">
                        <option value="Letter">Letter - US Letter (8.5x11 inches, or 216x279mm)</option>
                        <option value="Legal">Legal - US Legal (8.5x14 inches, or 216x356mm)</option>
                        <option value="A4">A4 - ISO A4 (8.27x11.69 inches, or 210x297mm)</option>
                    </select>
                </div>
            </div>

            <div class="row cont">
                <label class="col-sm-3 control-label"> Pages </label>
                <div class="col-sm-9">
                    <input type="text" name="pages" class="form-control compute"
                        placeholer="1,2,3 or 2-4 leave blank for all pages">
                    <span class="help-block">1,2,3 or 2-4 leave blank for all pages</span>
                </div>
            </div>

            <div class="row cont">
                <label class="col-sm-3 control-label"> Copies </label>
                <div class="col-sm-9">
                    <input type="number" name="copies" class="form-control compute" value="1" min="1">
                    <!-- <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span> -->
                </div>
            </div>
            <hr>
            <div class="row" id="sum">
                <div class="col-sm-12"> <span>Credits <span class="credits">credits PHP</span></span> </div>
                <div class="col-sm-12"> <span>Price: <span id="price"></span></span> </div>
                <div class="col-sm-12" id="bwpages"></div>
                <div class="col-sm-12" id="colpages"></div>
            </div>

        </div>
        <div class="modal-footer centered">
            <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button>
            <button class="btn btn-theme02 addcoins" type="button" data-toggle="modal" href="#addcoins">Add
                coins</button>
            <button class="btn btn-primary" onclick="compute()" id="sumbut" type="button" data-toggle="modal"
                href="#summary">Summary</button>
            <button onclick="printit()" class="btn btn-theme03" type="button">Print</button>
        </div>
    </div>
</div>
<script>
    const slidesContainer = document.getElementById("slides-container");
    const slide = document.querySelector(".slide");
    const prevButton = document.getElementById("slide-arrow-prev");
    const nextButton = document.getElementById("slide-arrow-next");
    let pageEl = document.querySelector("#page");
    const slideWidth = slide.clientWidth;

    nextButton.addEventListener("click", () => {
        pageEl.value++;
        // slidesContainer.scrollLeft += slide.clientWidth;
        slidesContainer.scrollLeft = slideWidth * pageEl.value;
    });

    prevButton.addEventListener("click", () => {
        pageEl.value--;
        slidesContainer.scrollLeft = slideWidth * pageEl.value;
        // slidesContainer.scrollLeft -= slideWidth;
    });
    // slidesContainer.addEventListener('scroll', (e) => {
    //     // if(e.target.scrollLeft % slideWidth<=1)
    //     page = Math.round(e.target.scrollLeft / slideWidth) + 1;
    // })

    function goToPage(page) {
        if(!isNaN(page))
            slidesContainer.scrollLeft = slideWidth * pageEl.value;
    }
</script>
