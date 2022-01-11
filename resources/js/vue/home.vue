<template>
    <div>

        <Header/>
        <Main />
        <Footer />
    </div>
</template>

<script>
import Header from './header.vue'
import Footer from './footer.vue'
import Main from './main.vue'

export default {
    components:{
        Header,
        Footer,
        Main
    }
}
</script>
