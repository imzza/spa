<template>
    <div class="cssload-aim-wrap">
    <div class="cssload-aim"></div></div>
</template>
<style scoped lang="scss">
.cssload-aim-wrap {
    background: rgba(255, 255, 255, 0.8);
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 11;

.cssload-aim {
    position: fixed;
    z-index: 1500;
    left: 50%;
    top: 130px;
    border-radius: 20px;
    background-color: transparent;
    border-width: 15px;
    border-style: double;
    border-color: transparent #F5333F;
    animation: cssload-anim 0.7s linear infinite;
    @media screen and (max-width: 560px) {
        top: 106px;
    }
}
}
@keyframes cssload-anim {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
