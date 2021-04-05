<template>
  
    <header>
        <div class="container">
            <div class="logo">
                <a href="">
                    <img src="/images/logo.png">
                </a>
            </div>
            <div class="menu">
                   
                <nav>
                     <div class="menuMobile">
                        <div class="mm_line"></div>
                        <div class="mm_line"></div>
                        <div class="mm_line"></div>
                    </div>
                    
                    <ul>
                        <li class="active"><a href="">Home</a></li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">Pages</a></li>
                        <li><a href="">Departaments</a></li>
                        <li><a href="">Timetable</a></li>
                        <li><a href="">Gallery</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div> 
    </header>
    <main>
        <slot/>
    </main>

    <front-footer />

</template>
<script>
    import FrontFooter from '@/Layouts/FrontFooter'

    export default ({
        components:{
            FrontFooter,
        }
    })

</script>


