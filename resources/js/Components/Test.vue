<script setup>
import { ref } from 'vue';

const props =  defineProps([
    'msg'
]); 

console.log(props.msg);


let count =  ref(7);
</script>

<template>
    <h1>Hello this is Vue Component - {{ msg }}</h1>
    <h1>Cont : {{ count }}</h1>
</template>