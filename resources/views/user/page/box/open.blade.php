@extends('user.layout.index')
@section('css')
    <link rel="stylesheet" href="./css/openbox.css">
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Mở Box</p>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{-- after open box --}}
        <div class="page__style page_after_open_box container">
            <div class="page__description p-2 mb-3">
                <div id="page_after_open_box" class="d-flex flex-column align-items-center">
                    <div class="giftboxs" aria-hidden="true">
                        <div class="giftbox">🎁</div>
                        <div class="giftbox">🎈</div>
                        <div class="giftbox">🎁</div>
                        <div class="giftbox">🎉</div>
                        <div class="giftbox">🎁</div>
                        <div class="giftbox">🎈</div>
                        <div class="giftbox">🎁</div>
                        <div class="giftbox">🎈</div>
                        <div class="giftbox">🎉</div>
                        <div class="giftbox">🎁</div>
                        <div class="giftbox">🎈</div>
                        <div class="giftbox">🎉</div>
                      </div>
                    <canvas id="canvas"></canvas>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="100%"
                            height="auto" />
                    </div>
                    <h2 class="mt-2">Chúc mừng bạn đã nhận được</h2>
                    <div class="row justify-content-center mb-5">
                        <div class="col-sm-5 col-6 p-2">
                            <div class="bg-white product-card-open-box rounded">
                                <p class="font-weight-bold text-dark">Title Title Title</p>
                                <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                            </div>
                        </div>
                        <div class="col-sm-5 col-6 p-2">
                            <div class="bg-white product-card-open-box rounded">
                                <p class="font-weight-bold text-dark">Title Title Title</p>
                                <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                            </div>
                        </div>
                        <div class="col-sm-5 col-6 p-2">
                            <div class="bg-white product-card-open-box rounded">
                                <p class="font-weight-bold text-dark">Title Title Title</p>
                                <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                            </div>
                        </div>
                        <div class="col-sm-5 col-6 p-2">
                            <div class="bg-white product-card-open-box rounded">
                                <p class="font-weight-bold text-dark">Title Title Title</p>
                                <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- page open box --}}
        <div class="page__style page_open_box container">
            <div class="page__description p-2 mb-3">
                <div id="page_open_box" class="d-flex flex-column align-items-center">
                    <h3>Đây là danh sách những món quà trong box</h3>
                    <div class="row justify-content-center">
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                        <div class="product-card-box p-2">
                            <div class="bg-white rounded">
                                <div class="opacity-75">
                                    <p class="font-weight-bold text-dark">Title Title Title</p>
                                    <span class="price bg-danger text-white font-weight-bold px-1 py-2 rounded-circle">Giá:
                                        2.000.000 VND</span>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDKg2V4RwKxDjPmJV_1GTsOCeE1Iv_37TJPFte8uf0Gg&s"
                                        class="mt-3 rounded-bottom">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Sau khi ấn mở box, bạn sẽ nhận được 4 trong 10 món phía trên</h4>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <img src="https://vn-live-01.slatic.net/p/dbf45cda7d56f7641227a80a5957efdf.jpg" width="100%"
                            height="auto" />
                    </div>
                    <button id="openBox" class="btn_nav btn bg-orange open_box text-white mt-2 mb-5">Mở Box</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.btn_nav').click(function() {
            // animate content
            $('.page__style').addClass('animate_content');
            $('.page__description').fadeOut(100).delay(100).fadeIn();

            setTimeout(function() {
                $('.page__style').removeClass('animate_content');
            }, 3200);

            //remove fadeIn class after 1500ms
            setTimeout(function() {
                $('.page__style').removeClass('fadeIn');
            }, 1500);

        });

        // on click show page after 1500ms
        // $('.open_box').click(function() {
        //     setTimeout(function() {
        //         $('.page_after_open_box').addClass('fadeIn');
        //     }, 1500);
        // });
    </script>
    <script>
        // when animating on canvas, it is best to use requestAnimationFrame instead of setTimeout or setInterval
        // not supported in all browsers though and sometimes needs a prefix, so we need a shim
        window.requestAnimFrame = (function() {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                function(callback) {
                    window.setTimeout(callback, 100 / 60);
                };
        })();

        // now we will setup our basic variables for the demo
        var canvas = document.getElementById('canvas'),
            ctx = canvas.getContext('2d'),
            // full screen dimensions
            cw = window.innerWidth,
            ch = window.innerHeight,
            // firework collection
            fireworks = [],
            // particle collection
            particles = [],
            // starting hue
            hue = 120,
            // when launching fireworks with a click, too many get launched at once without a limiter, one launch per 5 loop ticks
            limiterTotal = 20,
            limiterTick = 0,
            // this will time the auto launches of fireworks, one launch per 80 loop ticks
            timerTotal = 500,
            timerTick = 0,
            mousedown = false,
            // mouse x coordinate,
            mx,
            // mouse y coordinate
            my;


        // set canvas dimensions
        canvas.width = cw;
        canvas.height = ch;

        // now we are going to setup our function placeholders for the entire demo

        // get a random number within a range
        function random(min, max) {
            return Math.random() * (max - min) + min;
        }

        // calculate the distance between two points
        function calculateDistance(p1x, p1y, p2x, p2y) {
            var xDistance = p1x - p2x,
                yDistance = p1y - p2y;
            return Math.sqrt(Math.pow(xDistance, 2) + Math.pow(yDistance, 2));
        }

        // create firework
        function Firework(sx, sy, tx, ty) {
            // actual coordinates
            this.x = sx;
            this.y = sy;
            // starting coordinates
            this.sx = sx;
            this.sy = sy;
            // target coordinates
            this.tx = tx;
            this.ty = ty;
            // distance from starting point to target
            this.distanceToTarget = calculateDistance(sx, sy, tx, ty);
            this.distanceTraveled = 0;
            // track the past coordinates of each firework to create a trail effect, increase the coordinate count to create more prominent trails
            this.coordinates = [];
            this.coordinateCount = 3;
            // populate initial coordinate collection with the current coordinates
            while (this.coordinateCount--) {
                this.coordinates.push([this.x, this.y]);
            }
            this.angle = Math.atan2(ty - sy, tx - sx);
            this.speed = 2;
            this.acceleration = 1.05;
            this.brightness = random(50, 70);
            // circle target indicator radius
            this.targetRadius = 1;
        }

        // update firework
        Firework.prototype.update = function(index) {
            // remove last item in coordinates array
            this.coordinates.pop();
            // add current coordinates to the start of the array
            this.coordinates.unshift([this.x, this.y]);

            // cycle the circle target indicator radius
            if (this.targetRadius < 8) {
                this.targetRadius += 0.3;
            } else {
                this.targetRadius = 1;
            }

            // speed up the firework
            this.speed *= this.acceleration;

            // get the current velocities based on angle and speed
            var vx = Math.cos(this.angle) * this.speed,
                vy = Math.sin(this.angle) * this.speed;
            // how far will the firework have traveled with velocities applied?
            this.distanceTraveled = calculateDistance(this.sx, this.sy, this.x + vx, this.y + vy);

            // if the distance traveled, including velocities, is greater than the initial distance to the target, then the target has been reached
            if (this.distanceTraveled >= this.distanceToTarget) {
                createParticles(this.tx, this.ty);
                // remove the firework, use the index passed into the update function to determine which to remove
                fireworks.splice(index, 1);
            } else {
                // target not reached, keep traveling
                this.x += vx;
                this.y += vy;
            }
        }

        // draw firework
        Firework.prototype.draw = function() {
            ctx.beginPath();
            // move to the last tracked coordinate in the set, then draw a line to the current x and y
            ctx.moveTo(this.coordinates[this.coordinates.length - 1][0], this.coordinates[this.coordinates.length - 1][
                1
            ]);
            ctx.lineTo(this.x, this.y);
            ctx.strokeStyle = 'hsl(' + hue + ', 100%, ' + this.brightness + '%)';
            ctx.stroke();

            ctx.beginPath();
            // draw the target for this firework with a pulsing circle
            //ctx.arc( this.tx, this.ty, this.targetRadius, 0, Math.PI * 2 );
            ctx.stroke();
        }

        // create particle
        function Particle(x, y) {
            this.x = x;
            this.y = y;
            // track the past coordinates of each particle to create a trail effect, increase the coordinate count to create more prominent trails
            this.coordinates = [];
            this.coordinateCount = 5;

            while (this.coordinateCount--) {
                this.coordinates.push([this.x, this.y]);
            }
            // set a random angle in all possible directions, in radians
            this.angle = random(0, Math.PI * 2);
            this.speed = random(1, 10);
            // friction will slow the particle down
            this.friction = 0.95;
            // gravity will be applied and pull the particle down
            this.gravity = 0.6;
            // set the hue to a random number +-20 of the overall hue variable
            this.hue = random(hue - 20, hue + 20);
            this.brightness = random(50, 80);
            this.alpha = 1;
            // set how fast the particle fades out
            this.decay = random(0.0075, 0.009);
        }

        // update particle
        Particle.prototype.update = function(index) {
            // remove last item in coordinates array
            this.coordinates.pop();
            // add current coordinates to the start of the array
            this.coordinates.unshift([this.x, this.y]);
            // slow down the particle
            this.speed *= this.friction;
            // apply velocity
            this.x += Math.cos(this.angle) * this.speed;
            this.y += Math.sin(this.angle) * this.speed + this.gravity;
            // fade out the particle
            this.alpha -= this.decay;

            // remove the particle once the alpha is low enough, based on the passed in index
            if (this.alpha <= this.decay) {
                particles.splice(index, 1);
            }
        }

        // draw particle
        Particle.prototype.draw = function() {
            ctx.beginPath();
            // move to the last tracked coordinates in the set, then draw a line to the current x and y
            ctx.moveTo(this.coordinates[this.coordinates.length - 1][0], this.coordinates[this.coordinates.length - 1][
                1
            ]);
            ctx.lineTo(this.x, this.y);
            ctx.strokeStyle = 'hsla(' + this.hue + ', 100%, ' + this.brightness + '%, ' + this.alpha + ')';

            ctx.stroke();
        }

        // create particle group/explosion
        function createParticles(x, y) {
            // increase the particle count for a bigger explosion, beware of the canvas performance hit with the increased particles though
            var particleCount = 20;
            while (particleCount--) {
                particles.push(new Particle(x, y));
            }
        }


        // main demo loop
        function loop() {
            // this function will run endlessly with requestAnimationFrame
            requestAnimFrame(loop);

            // increase the hue to get different colored fireworks over time
            hue += 0.5;

            // normally, clearRect() would be used to clear the canvas
            // we want to create a trailing effect though
            // setting the composite operation to destination-out will allow us to clear the canvas at a specific opacity, rather than wiping it entirely
            ctx.globalCompositeOperation = 'destination-out';
            // decrease the alpha property to create more prominent trails
            ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
            ctx.fillRect(0, 0, cw, ch);
            // change the composite operation back to our main mode
            // lighter creates bright highlight points as the fireworks and particles overlap each other
            ctx.globalCompositeOperation = 'lighter';

            // loop over each firework, draw it, update it
            var i = fireworks.length;
            while (i--) {
                fireworks[i].draw();
                fireworks[i].update(i);
            }

            // loop over each particle, draw it, update it
            var i = particles.length;
            while (i--) {
                particles[i].draw();
                particles[i].update(i);

            }


            // launch fireworks automatically to random coordinates, when the mouse isn't down
            if (timerTick >= timerTotal) {
                timerTick = 0;
            } else {
                var temp = timerTick % 400;
                if (temp <= 15) {
                    fireworks.push(new Firework(100, ch, random(190, 200), random(90, 100)));
                    fireworks.push(new Firework(cw - 100, ch, random(cw - 200, cw - 190), random(90, 100)));
                }

                var temp3 = temp / 10;

                if (temp > 319) {
                    fireworks.push(new Firework(300 + (temp3 - 31) * 100, ch, 300 + (temp3 - 31) * 100, 200));
                }

                timerTick++;
            }

            // limit the rate at which fireworks get launched when mouse is down
            if (limiterTick >= limiterTotal) {
                if (mousedown) {
                    // start the firework at the bottom middle of the screen, then set the current mouse coordinates as the target
                    fireworks.push(new Firework(cw / 2, ch, mx, my));
                    limiterTick = 0;
                }
            } else {
                limiterTick++;
            }
        }

        // mouse event bindings
        // update the mouse coordinates on mousemove
        canvas.addEventListener('mousemove', function(e) {
            mx = e.pageX - canvas.offsetLeft;
            my = e.pageY - canvas.offsetTop;
        });

        // toggle mousedown state and prevent canvas from being selected
        canvas.addEventListener('mousedown', function(e) {
            e.preventDefault();
            mousedown = true;
        });

        canvas.addEventListener('mouseup', function(e) {
            e.preventDefault();
            mousedown = false;
        });

        // once the window loads, we are ready for some fireworks!
        window.onload = loop;
        $('#openBox').click(function(event) {
            var id_cart = '{{$cart->id}}';
            $.ajax({
                method: 'POST',
                url: '{{ route("openBoxPost", ["id_cart"=>$cart->id]) }}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                // data: $(this).serialize(),
                success: function(response) {
                    setTimeout(function() {
                        $('.page_after_open_box').addClass('fadeIn');
                    }, 1500);
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("Mở box thảnh công");
                },
                error: function(response) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.warning("Mở box không thành công");
                }
            });
        });
    </script>
@endsection
