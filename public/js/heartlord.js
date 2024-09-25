// https://codepen.io/bnewton/pen/KMbLZx
document.addEventListener('DOMContentLoaded', function () {
    // Easing function for scaling animation
    const scaleCurve = mojs.easing.path('M0,100 L25,99.9999983 C26.2328835,75.0708847 19.7847843,0 100,0');

    // Select all elements with the class 'button-heart'
    const heartButtons = document.querySelectorAll('.button-heart');

    // Iterate over each heart button
    heartButtons.forEach((el) => {
        // Create a separate timeline for each element
        const timeline = new mojs.Timeline();

        // Burst animations
        const tween1 = new mojs.Burst({
            parent: el,
            radius: { 0: 100 },
            angle: { 0: 45 },
            y: -10,
            count: 10,
            children: {
                shape: 'circle',
                radius: 30,
                fill: ['red', 'white'],
                strokeWidth: 15,
                duration: 500,
            }
        });

        const tween2 = new mojs.Tween({
            duration: 900,
            onUpdate: function (progress) {
                const scaleProgress = scaleCurve(progress);
                el.style.transform = `scale3d(${scaleProgress}, ${scaleProgress}, 1)`;
            }
        });

        const tween3 = new mojs.Burst({
            parent: el,
            radius: { 0: 100 },
            angle: { 0: -45 },
            y: -10,
            count: 10,
            children: {
                shape: 'circle',
                radius: 30,
                fill: ['white', 'red'],
                strokeWidth: 15,
                duration: 400,
            }
        });

        // Add tweens to the timeline
        timeline.add(tween1, tween2, tween3);

        // Click event for each heart button
        el.addEventListener('click', function () {
            if (el.classList.contains('active')) {
                el.classList.remove('active');
            } else {
                timeline.play();
                el.classList.add('active');
            }
        });
    });
});
