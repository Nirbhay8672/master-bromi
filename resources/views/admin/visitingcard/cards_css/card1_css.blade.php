/**
* Business Card - Materialize Styled
*/
<style>


/* ********************************************************************************* */
@import 'https://fonts.googleapis.com/css?family=Open+Sans|Roboto:300';

$padding:30px;


.container1 {
  perspective: 800px;
  
  /* Styling */  
  color: #fff;
  font-family: 'Open Sans', sans-serif;
  /* text-transform: uppercase; */
  /* letter-spacing: 4px; */
  
  /* Center it */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.card1 {
  /* Styling */
  width: 600px;
  height: 300px;
  background: rgb(61, 59, 59);
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);  
  
  /* Card flipping effects */
  transform-style: preserve-3d;
  transition: 0.6s; 
}
.3 {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  /* Fix Chrome rendering bug */
  transform: rotate(0deg) translateZ(1px);
}

/* Flip the card on hover */
.container1:hover .card1,
.back1 {
  transform: rotateY(-180deg) translateZ(1px);
}

/* Front styling */
.container1 .front1 {
  /* Center the name + outline (almost) */
  line-height: 390px; /* Height - some (because visual center is a little higher than actual center) */
  text-align: center;
}
.logo1 {
  outline: 1px solid #19F6E8;
  display: inline-block;
  padding: 15px 40px;
  
  text-transform: uppercase;
  font-family: 'Roboto', sans-serif;
  font-size: 1.4em;
  font-weight: normal;
  line-height: 32px;
  letter-spacing: 8px;
}

/* Back styling */
.container1 .back1 {
  background: #15CCC0;
  padding: $padding;
}
.back1 .name1 {
  color: #3B3B3B;
  margin-bottom: 0;
}
.container1 .info1 p {
  margin: 0.8em 0;
}
.back1 .info1 {
  position: absolute;
  bottom: $padding;
  left: $padding;
  color: #3b3b3b;
}
.container1 .property1 {
  color: #fff;
}

/* Make semi-responsive */
@media (max-width:700px) {
  .card1 { transform: scale(.5); }
  .container1:hover .card1 { transform: scale(.5) rotateY(-180deg) translateZ(1px); }
}
/* **************************************************************** */
 .container2 {
  width: 600px;
  height: 340px;
  margin: 0 auto; 
  position: relative;
  -webkit-perspective: 1000;
	-moz-perspective: 1000;
	perspective: 1000;
  -moz-transform: perspective(1400px);
	-ms-transform: perspective(1400px);
	-webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d; 
  transform-style: preserve-3d;
  -webkit-perspective-origin: right;
  -moz-perspective-origin: right;
  perspective-origin: right;
}
.card2 {
  width: 600px;
  height: 340px;
  box-shadow: 0 27px 55px 0 rgba(0, 0, 0, .7), 0 17px 17px 0 rgba(0, 0, 0, .5);
  position: relative; 
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -ms-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transform-origin: 100% 0%;
  -moz-transform-origin: 100% 0%;
  -ms-transform-origin: 100% 0%;
  transform-origin: 100% 0%;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d; 
  transform-style: preserve-3d;
  transition: .8s ease-in-out;
}

.logo2 {
  width: 200px;
  height: 200px;
  position: relative;
  background:
  linear-gradient(45deg, #F5AF69 50%, #F4EED7 50.9%),
  linear-gradient(90deg, #FC5135 50%, #4E203C 50%),
  linear-gradient(-45deg, #F5AF69 50%, #E8D9A0 50.9%), 
  linear-gradient(#FC5135 50%, #4E203C 50%),
  linear-gradient(-45deg, #F5AF69 50%, #E8D9A0 50.9%),
  linear-gradient(90deg, #FC5135 50%, #4E203C 50%),
  linear-gradient(45deg, #FC5135 50%, #F5AF69 50.9%);
  background-size: 50px 50px, 100px 50px, 50px 50px, 200px 100px, 50px 50px, 100px 50px, 50px 50px;
  background-repeat: no-repeat;
  background-position: 0 0, 50px 0px, 150px 0, 0 50px, 0 150px, 50px 150px, 150px 150px;
}
.logo2:before {
  content: "";
  position: absolute;
  top: 30px;
  left: 30px;
  width: 140px;
  height: 140px;
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
  background: linear-gradient(45deg, #F4EED7 50%, #E8D9A0 50%);
}
.logo2:after {
  content: "";
  position: absolute;
  top: 55px;
  left: 55px;
  width: 90px;
  height: 90px;
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
  background: linear-gradient(45deg, #FC5135 50%, #4E203C 49.9%),
  linear-gradient(-45deg, #F5AF69 50%, transparent 50%),
  linear-gradient(#FC5135 50%, #FC5135 50%),
  linear-gradient(-45deg, #4E203C 50%, transparent 50%);
  background-size: 45px 45px;
  background-repeat: no-repeat;
  background-position: 0 0, 0 45px, 45px 45px, 45px 0;
  border-radius: 0 50% 50% 50%;
}
.logo2 span {
  display: block;
  background: #4E203C;
  width: 29px;
  height: 32px;
  position: absolute;
  top: 99.5px;
  left: 130px;
  border-radius: 0 50% 50% 0;
}
.logo2 span:before {
  content: "";
  width: 10px;
  height: 10px;
  background: #E8D9A0;
  border-radius: 50%;
  position: absolute;
  top: 11px;
  left: 10px;
  z-index: 2;
}
.front2, .back2 {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: white;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  backface-visibility: hidden;
}
.front2 {
  display:-webkit-flex;
  display: flex;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-align-items: center;
  align-items: center;
  z-index: 2;
  -webkit-transform: rotateY(0deg);
  -moz-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  transform: rotateY(0deg);
}
.back2 {
  -webkit-transform: rotateY(-180deg);
  -moz-transform: rotateY(-180deg);
  -ms-transform: rotateY(-180deg);
  transform: rotateY(-180deg);
  font-family: 'Arimo', sans-serif;
}
.container2:hover .card2 {
  -webkit-transform: rotateY(180deg) translateX(100%);
  -moz-transform: rotateY(180deg) translateX(100%);
  -ms-transform: rotateY(180deg) translateX(100%);
  transform: rotateY(180deg) translateX(100%);
  cursor: pointer;
}
.back2 ul {
  margin: 0;
  width: 100%;
  list-style: none;
  position: absolute;
  bottom: 30px;
  left: 0;
  padding: 0 1%;
}
.back2 ul:after {
  content: '';
  display: table;
  clear: both;
}
.back2 li {
  width: 31.3333333333%;
  margin: 0 1%;
  float: left;
  padding: 10px;
  border: 2px solid #FC5135;
  border-radius: 4px;
  position: relative;
  text-align: center;
  color: #4E203C;
}
.back2 li:before {
  position: absolute;
  top: -25px;
  left: 50%;
  margin-left: -15px;
  width: 30px;
  height:30px;
  background: #FC5135;
  color: white;
  line-height: 30px;
  text-align: center;
  border-radius: 50%;
  font-family: FontAwesome;
}
.back2 li:nth-child(1):before {content: "\f095"}
.back2 li:nth-child(2):before {content: "\f003"}
.back2 li:nth-child(3):before {content: "\f0c1"}
.back2 h1 {
  color: #FC5135;
  text-transform: uppercase;
  font-weight: 400;
  line-height: 1;
  margin-top: 110px;
  text-align: center;
  font-size: 40px;
}
h1 span {
  color: #4E203C;
  display: block;
  font-size: .45em;
  letter-spacing: 3px;
}
h1 i {
  font-style: normal;
  text-transform: none;
  font-family: 'Playfair Display', serif;
} 
/* ************************************************************************************ */
/* ********************************************************************************* */
@import 'https://fonts.googleapis.com/css?family=Open+Sans|Roboto:300';

$padding:30px;


.container3 {
  perspective: 800px;
  
  /* Styling */  
  color: #fff;
  font-family: 'Open Sans', sans-serif;
  text-transform: uppercase;
  letter-spacing: 4px;
  
  /* Center it */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.card3 {
  /* Styling */
  perspective: 1000px;
  width: 600px;
  height: 300px;
  background: rgb(11, 74, 136);
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);  
  
  /* Card flipping effects */
  transform-style: preserve-3d;
  transition: 0.6s; 
}
.card3 .card-back {
            transform: rotateX(180deg);
        }

/* download */

        .card3 .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.8s;
        }
        .card3 .card-front, .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }
        .card3 .card-front {
            transform: rotateY(0deg);
        }
        .card3 .card-back {
            transform: rotateY(180deg);
        }
        .card3 .card.flip .card-inner {
            transform: rotateY(180deg);
        }

        .card-front {
    background-color: #13293D; /* Change the background color of the front side */
    color: white; /* Change the text color of the front side */
}


.side3 {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  /* Fix Chrome rendering bug */
  transform: rotate(0deg) translateZ(1px);
}

/* Flip the card on hover */
.container3:hover .card3,
.back3 {
  transform: rotateY(-180deg) translateZ(1px);
}

/* Front styling */
.container3 .front3 {
  /* Center the name + outline (almost) */
  line-height: 390px; /* Height - some (because visual center is a little higher than actual center) */
  text-align: center;
}
.logo3 {
  outline: 1px solid #174a90;
  display: inline-block;
  padding: 15px 40px;
  
  text-transform: uppercase;
  font-family: 'Roboto', sans-serif;
  font-size: 1.4em;
  font-weight: normal;
  line-height: 32px;
  letter-spacing: 8px;
}

/* Back styling */
.container3 .back3 {
  background: #155385;
  padding: $padding;
}
.back3 .name3 {
  padding-top: 23px;
    color: #e0f0f1;
    margin-bottom: 27px;
}
.container3 .info3 p {
  margin: 0.8em 0;
}
 .info3 {
  /* position: absolute; */
  bottom: $padding;
  /* left: $padding; */
  color:  #fff;
}
.info3 .property3 {
  color: #fff;
}

/* Make semi-responsive */
@media (max-width:700px) {
  .card3 { transform: scale(.5); }
  .container3:hover .card3 { transform: scale(.5) rotateY(-180deg) translateZ(1px); }
}


/* *********************************************************************************************** */

html {
  font-family: 'Arial';
  background: url('https://subtlepatterns.com/patterns/purty_wood.png');
}

a {
  color: #c20;
  text-decoration: underline;
}

.centered {
  margin: 0 auto;
}

.finer-print {
  font-size: 15px;
}

.span2 {
  width: 40%;
  padding: 0;
  float: left;
}

.business-card {
    position: inherit;
    /* background-color: #f5f5f5; */
    background: antiquewhite;
    color: #2e3436;
    width: 595px;
    height: 295px;
    font-size: 20px;
    border-bottom: 2px solid #d3d7df;
    border-radius: 15px;
    box-shadow: 0 0 10px 1px #000;
    margin-top: 1%;
}

.business-card .title {
  background: #c00;
  color: #fff;
  height: 53px;
  padding: 10px;
  font-weight: bold;
  font-size: 25px;
  border-top: 2px solid #ef2929;
  border-left: 2px solid #ef2929;
  border-radius: 14px 14px 0 0;
}

.business-card .content {
  font-weight: bold;
  padding: 15px;
}

.business-card .avatar {
  float: right;
  max-width: 100px;
  max-height: 100px;
  box-shadow: 0 0 10px 1px #777;
  border-radius: 3px;
}

.business-card .footer {
  position: absolute;
  bottom: 10px;
  left: 2%;
  font-size: 15px;
  padding-top: 5px;
  border-top: 1px solid;
  width: 96%;
}

@media (max-width: 480px) {
            .card3 {
                max-width: 100%;
                height: auto;
                margin: 20px;
            }
        } 
/* ******************************************************************* */

@media (max-width: 480px) {
            .card4 {
                max-width: 100%;
                height: auto;
                margin: 20px;
            }
        }
.card4 {
    color: aliceblue;
    width: 600px;
    height: 299px;
    background-color: #eb2c62;
    padding: 20px;
    border-radius: 64px;
    font-style: italic;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .name4 {
            color: aliceblue;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .designation4 {
            color: aliceblue;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .contact4 {
            color: aliceblue;
            font-size: 14px;
           
            margin-bottom: 10px;
        }
        @media (max-width: 480px) {
            .card4 {
                max-width: 100%;
                height: auto;
                margin: 20px;
            }
          }
/* ********************************************************** */
.card5 {
    width: 613px;
    height: 300px;
    background-color: #FFD700;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    font-family: Arial, sans-serif;
        }

        .name5 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #4A4A4A;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .designation5 {
            font-size: 18px;
            color: #6F2DBD;
            margin-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .contact5 {
            font-size: 14px;
            color: #4A4A4A;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .social5 {
            margin-top: 10px;
        }

        .social5 a {
            display: inline-block;
            color: #4A4A4A;
            text-decoration: none;
            margin: 0 5px;
            transition: color 0.3s ease;
        }

        .social5 a img {
            width: 16px;
            height: 16px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .social5 a:hover {
            color: #6F2DBD;
        }
        @media (max-width: 480px) {
            .card5 {
                max-width: 100%;
                height: auto;
                margin: 20px;
            }
        }  
        /* ********************************************** */
        .card6 {
    width: 613px;
    height: 300px;
    background-color: #232427;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    font-family: Arial, sans-serif;
        }
        @media (max-width: 480px) {
            .card6 {
                max-width: 100%;
                height: auto;
                margin: 20px;
            }
        } 
        
        
        /***********************************************/
        @import url(https://fonts.googleapis.com/css?family=Lato);

$lato: "Lato";
$black: #000;
$white: #fff;

/* CENTERING */

.centered7 {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}

@mixin vertical-align($position: relative) {
  position: $position;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

/* /end */



h3{
   position: relative;
   left: 45%;
}

/* THE FRONT */

.front{
    background-image:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/326221/bc-front.jpg);
   background-size:cover;
}

/* /end */

/* THE BACK */

.back{
   background-image:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/326221/bc-back.jpg);
   background-size:cover;

   h1, p, .font-a-icons {
      color: $black;
      font-family: $lato;
      margin-left: 30%;
      line-height: 90%;
   }   
   
   h1{
      margin-top: 5%;    
   }
   
   p{
      font-size: 16px;
      padding-bottom: 15px;
      width: 35%;
      border-bottom: 2px solid $black;
   }
   
   .bold{
      font-weight: bold;
   }
   
   .font-a-icons{    
      margin-top: 25px;
   }
   .back .font-a-icons .icon-group{
         margin-top: 8px;
      }
      
      span, .link, .fa, a{
         color: $black;
      }  
      
      .fa{
         font-size: 18px;
      }
      
      span, a{
         font-size: 16px;
      }
      
      a, .website{
         text-decoration: none;
      }
      
      a:hover, .website:hover{
         color: #3f3f3f;
      }     
   }
   .back h1, p, .font-a-icons {
      color: $black;
      font-family: "lato";
      margin-left: 30%;
      line-height: 90%;
   }  
   .back .icon-box{
      position: relative;
      color: $black;
      font-size: 24px;
      height: 45px;
      width: 45px;
      padding: 5px;
      top: 75px;
      left: 30%;
      display: inline-block;
      border: 2px solid $black;
      margin: 5px;
      text-align: center;
      cursor: pointer;
      -webkit-transition: all ease 0.5s;
	      -moz-transition: all ease 0.5s;
	         transition: all ease 0.5s;
   }
   .icon-box:hover {
    box-shadow: inset 0 50px 0 0 $black;
    color: $white;
   }


/* /end */

/* THE FLIP EFFECT */

/* entire container, keeps perspective */
.flip-container {
	perspective: 1000px;
}
	/* flip the pane when hovered */
	.flip-container:hover .flipper, .flip-container.hover .flipper {
		transform: rotateY(180deg);
      cursor: pointer;
	}

.flip-container, .front, .back {
   height: 350px;
   width: 600px;
}

.flipper {
	transition: 0.5s;
	transform-style: preserve-3d;
	position: relative;
}

.front, .back {
	backface-visibility: hidden;
	position: absolute;
}

.front {
	z-index: 2;
	/* firefox 31 */
	transform: rotateY(0deg);
}

.back{
   background-color: $black;
}

.back {
	transform: rotateY(180deg);
}

.vertical.flip-container {
	position: relative;
}

	.vertical .back {
		transform: rotateX(180deg);
	}

	.vertical.flip-container .flipper {
		transform-origin: 100% 400x; 
	}

	.vertical.flip-container:hover .flipper {
		transform: rotateX(-180deg);
	}

</style>