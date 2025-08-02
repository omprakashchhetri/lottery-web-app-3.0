<div class="container-fluid">
    <?php // echo "<pre>"; print_r($resultArray);?>
    <div class="body-container">
        <div class="heading-wrapper p-0">
            <h4 class="bg-primary text-center font-body heading-1">
                <?= STATENAME ?> STATE LOTTERIES
            </h4>
        </div>
        <div class="heading-wrapper">
            <h2 class="heading-2 font-body"><strong><?= LOTTERYNAME ?></strong></h2>
        </div>
        <div class="heading-wrapper p-0">
            <div class="marquee-container bg-primary text-center "
                style="overflow: hidden; position: relative; width: 100%; min-height: 50px">
                <h4 class="marquee-text mt-1 mb-0 font-body heading-3" style="position: absolute; white-space: nowrap;">
                    Welcome to the <?= ucwords(strtolower(STATENAME)) ?> State Lotteries. Daily draws are conducted at
                    around 2:00 PM and 9:00 PM.
                    Check your
                    results regularly and stand a chance to win life-changing rewards. Play responsibly.
                </h4>
            </div>
        </div>
        <div class="para-wrapper">
            <p class="font-body para-color para-align">
                Stay updated with the latest results and information about
                <?= ucwords(strtolower(STATENAME)); ?> State Lotteries. Your gateway to winning opportunities
                awaits.
            </p>
        </div>
        <div class="content-wrapper">
            <div class="download-option-btns">
                <!-- 2 PM Download Button -->
                <?php if ($processedResults['2pm']['showDownload'] && $processedResults['2pm']['result']): ?>
                <a href="<?=base_url('files/download/' . basename($processedResults['2pm']['result']->pdf_path))?>"
                    target="_blank" class="download-btn-78asbcabc custom-btn font-body">02:00 P.M</a>
                <?php else: ?>
                <span class="download-btn-78asbcabc custom-btn font-body"
                    style="opacity: 0.5; cursor: not-allowed;">02:00 P.M</span>
                <?php endif; ?>

                <!-- 9 PM Download Button -->
                <?php if ($processedResults['9pm']['showDownload'] && $processedResults['9pm']['result']): ?>
                <a href="<?=base_url('files/download/' . basename($processedResults['9pm']['result']->pdf_path))?>"
                    target="_blank" class="download-btn-78asbcabc custom-btn font-body">09:00 P.M</a>
                <?php else: ?>
                <span class="download-btn-78asbcabc custom-btn font-body"
                    style="opacity: 0.5; cursor: not-allowed;">09:00 P.M</span>
                <?php endif; ?>

                <a href="<?=base_url('old-results')?>"
                    class="download-btn-78asbcabc custom-btn custom-dark-btn font-body">OLD RESULTS</a>
            </div>
            <div class="divider"></div>
        </div>
        <div class="result-content">
            <!-- 2 PM Result Section -->
            <div class="result-first-main">
                <div class="content-wrapper p-0">
                    <h4 class="bg-primary text-center font-body heading-4">
                        <?php if ($processedResults['2pm']['result']): ?>
                        <?= date('d-m-Y', strtotime($processedResults['2pm']['result']->draw_date)) ?>
                        <?php else: ?>
                        <?= date('d-m-Y') ?>
                        <?php endif; ?>
                    </h4>
                </div>
                <div class="heading-wrapper">
                    <h2 class="text-center font-body heading-5">
                        <strong>MORNING (02:00 P.M)</strong>
                    </h2>
                </div>
                <div class="result-content">
                    <?php if ($processedResults['2pm']['showImage'] && $processedResults['2pm']['result']): ?>
                    <img class="img-fluid"
                        src="<?=base_url('files/image/' . basename($processedResults['2pm']['result']->result_image))?>"
                        alt="2 PM Lottery Result" />
                    <?php if ($processedResults['2pm']['message']): ?>
                    <div class="alert alert-info mt-3 text-center">
                        <small class="font-body"><?= $processedResults['2pm']['message'] ?></small>
                    </div>
                    <?php endif; ?>
                    <?php else: ?>
                    <div class="text-center p-4"
                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
                        <p class="font-body para-color">
                            <?= $processedResults['2pm']['message'] ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 9 PM Result Section -->
            <div class="result-first-main">
                <div class="content-wrapper p-0">
                    <h4 class="bg-primary text-center font-body heading-4">
                        <?php if ($processedResults['9pm']['result']): ?>
                        <?= date('d-m-Y', strtotime($processedResults['9pm']['result']->draw_date)) ?>
                        <?php else: ?>
                        <?= date('d-m-Y') ?>
                        <?php endif; ?>
                    </h4>
                </div>
                <div class="heading-wrapper">
                    <h2 class="text-center font-body heading-5">
                        <strong>NIGHT (09:00 P.M)</strong>
                    </h2>
                </div>
                <div class="result-content">
                    <?php if ($processedResults['9pm']['showImage'] && $processedResults['9pm']['result']): ?>
                    <img class="img-fluid"
                        src="<?=base_url('files/image/' . basename($processedResults['9pm']['result']->result_image))?>"
                        alt="9 PM Lottery Result" />
                    <?php if ($processedResults['9pm']['message']): ?>
                    <div class="alert alert-info mt-3 text-center">
                        <small class="font-body"><?= $processedResults['9pm']['message'] ?></small>
                    </div>
                    <?php endif; ?>
                    <?php else: ?>
                    <div class="text-center p-4"
                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
                        <p class="font-body para-color">
                            <?= $processedResults['9pm']['message'] ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="draw-content">
            <div class="content-wrapper">
                <h1 class="heading-6 font-body">Draw Schedule</h1>
            </div>
            <div class="para-wrapper">
                <p class="draw-terms-para para-color font-body">
                    One times a day, a First Prize of Rs. 75 Lakhs is up for grabs in
                    the <?= ucwords(strtolower(STATENAME)); ?> Future Daily Lottery. Every day of the week has a
                    distinct name for the draws. For instance, the draws on Sunday
                    are referred to as Future Brook, the draws on Monday as Future
                    Stream, and so forth. Each draw's name and draw date are listed
                    in the table below.
                </p>
                <p class="draw-terms-para para-color font-body">
                    <?= ucwords(strtolower(STATENAME)); ?> Lottery on , at precisely 2:00 PM. This famous website
                    called the <?= ucwords(strtolower(STATENAME)); ?> Lottery, has built a reputation for quickly
                    publishing
                </p>
                <p class="draw-terms-para para-color font-body">
                    the most current lottery results. So, respected customers,
                    please accept these results for the <?= ucwords(strtolower(STATENAME)); ?> State Lotteries
                    2:00 PM Morning Result.
                </p>
                <p class="draw-terms-para para-color font-body">
                    Check Today Result 2 PM today <?= ucwords(strtolower(STATENAME)); ?> State Lotteries ,
                    <?= ucwords(strtolower(LOTTERYNAME)) ?>
                    Lottery Result 2:00 PM. As you know lottery draw (2:00 PM)
                    has been rescheduled and now being updated at 2:00 PM. You may
                    check <?= ucwords(strtolower(LOTTERYNAME)) ?> Lottery morning result here at 2:00 PM. Today
                    result will also be updated here on this page. Stay connected
                    with us to check your today's draw result of the day. Those who
                    have tickets for the draw (2:00 PM) stay connected with us.
                    Result will be updated soon here on this page. Stay tuned to
                    check more results of the day.
                </p>
            </div>
            <div class="tnc-section content-wrapper">
                <a class="common-button custom-btn tnc-btn tnc-main-btn font-button"
                    href="<?=base_url('document/Terms&Conditions.pdf')?>" target="_blank">Terms
                    &amp; Conditions</a>
            </div>
        </div>
    </div>
</div>