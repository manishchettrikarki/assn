jQuery(document).ready(function($){

    window.onload = function (){
        $(".bts-popup").delay(1000).addClass('is-visible');
    }

    //open popup
    $('.bts-popup-trigger').on('click', function(event){
        event.preventDefault();
        $('.bts-popup').addClass('is-visible');
    });

    //close popup
    $('.bts-popup').on('click', function(event){
        if( $(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup') ) {
            event.preventDefault();
            $(this).removeClass('is-visible');
        }
    });
    //close popup when clicking the esc keyboard button
    $(document).keyup(function(event){
        if(event.which=='27'){
            $('.bts-popup').removeClass('is-visible');
        }
    });

});


//become a member form js
if($('#member-form').length >0) {

    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'arrows',
        cycleSteps: true,
        autoAdjustHeight: true,
        enableURLhash: false,
        transition: {
            animation: 'slide-horizontal',//none/fade/slide-horizontal/slide-vertical/slide-swing
            speed: '400', // Transion animation speed
            easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'right', // left, right, center
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            toolbarExtraButtons: [
                $('<button class="btn btn-success finish d-none">Finish</button>')
            ] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
        },
        anchorSettings: {
            markDoneStep: true,
            removeDoneStepOnNavigateBack: true
        },
        enableFinishButton: true,
        onFinish: function(){
            $('.finish').removeClass('d-none');
        }
    }).on('leaveStep',function(e,anchorObject,currentStepIndex,nextStepIndex,stepDirection){
        if(stepDirection === 'forward'){
            if(!$('#member-form').valid()){
                $('#smartwizard').smartWizard({
                    errorSteps: [currentStepIndex]
                });
                $('.tab-content').height('auto');
                return false;
            } else {
                // console.log('currentStep',currentStepIndex);

                // if(nextStepIndex === 3){
                //     $('.finish').removeClass('d-none');
                //     // if($('#agentForm').valid()){
                //     //     $('#agentForm').submit();
                //     // }
                // }
            }
        } else {
            $('.finish').addClass('d-none');
        }
    }).on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        console.log(stepNumber);
        if(stepNumber === 5){
            $('.finish').removeClass('d-none');
        }else{
            $('.finish').addClass('d-none');
        }

    });;

    $('.finish').on('click',function(){
        $('#member-form').submit();
    });

    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });


    //
    // let step = document.getElementsByClassName('step');
    // let prevBtn = document.getElementById('prev-btn');
    // let nextBtn = document.getElementById('next-btn');
    // let submitBtn = document.getElementById('submit-btn');
    // let form = document.getElementsByTagName('form')[0];
    // let preloader = document.getElementById('preloader-wrapper');
    // let bodyElement = document.querySelector('body');
    // let succcessDiv = document.getElementById('success');
    // form.onsubmit = () => {
    //     return false
    // }
    // let current_step = 0;
    // let stepCount = 6
    // step[current_step].classList.add('d-block');
    // if (current_step == 0) {
    //     prevBtn.classList.add('d-none');
    //     submitBtn.classList.add('d-none');
    //     nextBtn.classList.add('d-inline-block');
    // }
    // const progress = (value) => {
    //     document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
    // }
    // nextBtn.addEventListener('click', () => {
    //     current_step++;
    //     let previous_step = current_step - 1;
    //     if ((current_step > 0) && (current_step <= stepCount)) {
    //         prevBtn.classList.remove('d-none');
    //         prevBtn.classList.add('d-inline-block');
    //         step[current_step].classList.remove('d-none');
    //         step[current_step].classList.add('d-block');
    //         step[previous_step].classList.remove('d-block');
    //         step[previous_step].classList.add('d-none');
    //         if (current_step === stepCount) {
    //             submitBtn.classList.remove('d-none');
    //             submitBtn.classList.add('d-inline-block');
    //             nextBtn.classList.remove('d-inline-block');
    //             nextBtn.classList.add('d-none');
    //         }
    //         form.validate();
    //     } else {
    //         if (current_step > stepCount) {
    //             form.submit();
    //         }
    //     }
    //     progress((100 / stepCount) * current_step);
    // });
    //
    //
    // prevBtn.addEventListener('click', () => {
    //     if (current_step > 0) {
    //         current_step--;
    //         let previous_step = current_step + 1;
    //         prevBtn.classList.add('d-none');
    //         prevBtn.classList.add('d-inline-block');
    //         step[current_step].classList.remove('d-none');
    //         step[current_step].classList.add('d-block')
    //         step[previous_step].classList.remove('d-block');
    //         step[previous_step].classList.add('d-none');
    //         if (current_step < stepCount) {
    //             submitBtn.classList.remove('d-inline-block');
    //             submitBtn.classList.add('d-none');
    //             nextBtn.classList.remove('d-none');
    //             nextBtn.classList.add('d-inline-block');
    //             prevBtn.classList.remove('d-none');
    //             prevBtn.classList.add('d-inline-block');
    //         }
    //     }
    //
    //     if (current_step === 0) {
    //         prevBtn.classList.remove('d-inline-block');
    //         prevBtn.classList.add('d-none');
    //     }
    //     progress((100 / stepCount) * current_step);
    // });
    //
    //
    // submitBtn.addEventListener('click', () => {
    //     // preloader.classList.add('d-block');
    //     form.submit();
    //
    //     const timer = ms => new Promise(res => setTimeout(res, ms));
    //
    //     timer(3000)
    //         .then(() => {
    //             bodyElement.classList.add('loaded');
    //         }).then(() => {
    //         step[stepCount].classList.remove('d-block');
    //         step[stepCount].classList.add('d-none');
    //         prevBtn.classList.remove('d-inline-block');
    //         prevBtn.classList.add('d-none');
    //         submitBtn.classList.remove('d-inline-block');
    //         submitBtn.classList.add('d-none');
    //         succcessDiv.classList.remove('d-none');
    //         succcessDiv.classList.add('d-block');
    //     })
    //
    // });
}