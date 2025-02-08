// SelectWrapper.vue
<template>
  <vue-select2
    :id="selectId"
    v-model="selectedValue"
    :options="internalOptions"
    :settings="selectSettings"
    @change="handleChange"
    @select="handleSelect"
    @remove="handleRemove"
  />
</template>

<script setup>
import { ref, watch, onMounted, computed } from 'vue';
import VueSelect2 from 'vue3-select2-component';

const props = defineProps({
  modelValue: {
    type: [Object, Array, Number, String, null],
    default: null,
  },
  options: {
    type: Array,
    required: true,
  },
  displayKey: {
    type: String,
    default: 'name',
  },
  searchKeys: {
    type: Array,
    default: () => ['name'],
  },
  placeholder: {
    type: String,
    default: 'Select an option',
  },
  multiple: {
    type: Boolean,
    default: false,
  },
  id: {
    type: String,
    required: true,
    default: 'default',
  },
});

const emit = defineEmits(['update:modelValue', 'change', 'select', 'remove']);

const selectedValue = ref(props.modelValue);

const selectSettings = ref({
  placeholder: props.placeholder,
  allowClear: true,
  templateResult: formatState,
  templateSelection: formatState,
  matcher: matchSearch,
  multiple: props.multiple,
});

const selectId = computed(() => `select-${props.id}`);
const internalOptions = ref(props.options);

watch(
  () => props.modelValue,
  (newValue) => {
    selectedValue.value = newValue;
  }
);

watch(
    () => props.options,
    (newOptions) => {
        selectSettings.value.options = newOptions
    }
)

watch(
  () => props.options,
  (newOptions) => {
    internalOptions.value = newOptions; // Update internalOptions
    selectSettings.value.options = newOptions; // Update options in settings too
  }
);

function formatState(state) {
  if (!state.id) {
    return state.text;
  }
  return state[props.displayKey];
}

function matchSearch(params, data) {
    if ($.trim(params.term) === '') {
        return data;
    }
    const searchTerm = params.term.toLowerCase();

    for (const key of props.searchKeys) {
        if (data[key] && data[key].toLowerCase().includes(searchTerm)) {
            return data;
        }
    }
    return null;
}

watch(selectedValue, (newValue) => {
  emit('update:modelValue', newValue);
});

const handleChange = (event) => {
  emit('change', event);
  emit('update:modelValue', selectedValue.value);
};

const handleSelect = (event) => {
  emit('select', event);
  emit('update:modelValue', selectedValue.value);
};

const handleRemove = (event) => {
  if (props.multiple) {
    emit('remove', event.removed);
  } else {
    emit('remove', event);
  }
  emit('update:modelValue', selectedValue.value);
};

onMounted(() => {
    if(props.modelValue){
        selectedValue.value = props.modelValue
    }
})

</script>