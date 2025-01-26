"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Components_Property_AddForm_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/AddForm.vue?vue&type=script&setup=true&lang=js":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/AddForm.vue?vue&type=script&setup=true&lang=js ***!
  \*********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'AddForm',
  props: ['property_for_type', 'property_construction_type', 'projects', 'cities', 'authuser', 'land_units', 'property_source'],
  setup: function setup(__props, _ref) {
    var __expose = _ref.expose;
    __expose();
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      $('#project_id').select2().on('change', function () {
        data.selected_project = $(this).val();
        if (data.selected_project > 0) {
          var project = props.projects.find(function (project) {
            return parseInt(project.id) == parseInt(data.selected_project);
          });
          data.address = project.address;
          data.location_link = project.location_link;
        }
      });
      $('#city_id').select2().on('change', function () {
        data.selected_city = $(this).val();
      });
      $('#locality_id').select2().on('change', function () {
        data.selected_locality = $(this).val();
      });
      $('#city_id').val(props.cities[0]['id']).trigger('change');
      $('#salable_area_unit').select2().on('change', function () {
        other_details.saleable_area_unit = $(this).val();
      });
      $('#ceiling_height_unit').select2().on('change', function () {
        other_details.ceiling_height_unit = $(this).val();
      });
      $('#carpet_area_unit').select2().on('change', function () {
        other_details.carpet_area_unit = $(this).val();
      });
      $('#terrace_saleable_area_unit').select2().on('change', function () {
        other_details.terrace_saleable_area_unit = $(this).val();
      });
      $('#terrace_carpet_area_unit').select2().on('change', function () {
        other_details.terrace_carpet_area_unit = $(this).val();
      });
      $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
      });
      $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
      });
      unitDetailsSelect2(); // for unit details
    });
    var props = __props;
    var age_of_property = ['0-1 Years', '1-5 Years', '5-10 Years', '10+ Years'];
    var data = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'property_for': null,
      'property_construction_type': null,
      'property_category': null,
      'property_sub_category': null,
      'selected_project': '',
      'selected_city': '',
      'selected_locality': '',
      'address': '',
      'location_link': ''
    });
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'saleable_area': '',
      'saleable_area_unit': '',
      'ceiling_height': '',
      'ceiling_height_unit': '',
      'add_carpet_area': '',
      'carpet_area': '',
      'carpet_area_unit': '',
      'is_terrace': '',
      'terrace_saleable_area': '',
      'terrace_saleable_area_unit': '',
      'add_terrace_carpet_area': '',
      'terrace_carpet_area': '',
      'terrace_carpet_area_unit': '',
      'units_in_project': '',
      'number_of_floor': '',
      'units_in_towers': '',
      'units_on_floor': '',
      'number_of_elevators': '',
      'service_elevator': '',
      'is_hot': '',
      'washrooms': '',
      'four_wheeler_parking': '',
      'two_wheeler_parking': '',
      'priority': '',
      'source': '',
      'availability_status': '',
      'age_of_property': '',
      'available_from': '',
      'remark': ''
    });
    var unit_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)([{
      'wing': '',
      'unit_number': '',
      'available': '',
      'price_rent': '',
      'furnished_status': ''
    }]);
    function unitDetailsSelect2() {
      unit_details.forEach(function (unit_detail, index) {
        $("#unit_available_".concat(index)).select2().on('change', function () {
          unit_details[index].available = $(this).val();
        });
        $("#furnished_status_".concat(index)).select2().on('change', function () {
          unit_details[index].furnished_status = $(this).val();
        });
      });
    }
    function addUnit() {
      unit_details.push({
        'wing': '',
        'unit_number': '',
        'available': '',
        'price_rent': '',
        'furnished_status': ''
      });
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.nextTick)(function () {
        unitDetailsSelect2();
      });
    }
    function removeUnit(index) {
      unit_details.splice(index, 1);
    }
    function resetValue(clicked_value) {
      // reset selected value on change input
      if (clicked_value == 1) {
        data.property_construction_type = null;
      }
      if (clicked_value == 1 || clicked_value == 2) {
        data.property_category = null;
      }
      data.property_sub_category = null;
    }
    var __returned__ = {
      props: props,
      age_of_property: age_of_property,
      data: data,
      other_details: other_details,
      unit_details: unit_details,
      unitDetailsSelect2: unitDetailsSelect2,
      addUnit: addUnit,
      removeUnit: removeUnit,
      resetValue: resetValue,
      reactive: vue__WEBPACK_IMPORTED_MODULE_0__.reactive,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_0__.onMounted,
      nextTick: vue__WEBPACK_IMPORTED_MODULE_0__.nextTick
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/AddForm.vue?vue&type=template&id=47c9e914":
/*!**************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/AddForm.vue?vue&type=template&id=47c9e914 ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }

var _hoisted_1 = {
  "class": "row"
};
var _hoisted_2 = {
  "class": "col-12 col-md-9 col-lg-10 border-start ps-4"
};
var _hoisted_3 = {
  "class": "row"
};
var _hoisted_4 = {
  "class": "row"
};
var _hoisted_5 = {
  "class": "col-12 col-md-12 mb-4"
};
var _hoisted_6 = ["value", "id"];
var _hoisted_7 = ["for"];
var _hoisted_8 = {
  "class": "col-md-12 mb-3"
};
var _hoisted_9 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2"
};
var _hoisted_10 = ["id", "value"];
var _hoisted_11 = ["for"];
var _hoisted_12 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_13 = {
  key: 0,
  "class": "btn-group bromi-checkbox-btn me-1 property-type-element",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_14 = ["value", "id"];
var _hoisted_15 = ["for"];
var _hoisted_16 = {
  key: 0,
  "class": "btn-group bromi-checkbox-btn me-1 property-type-element",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_17 = ["value", "id"];
var _hoisted_18 = ["for"];
var _hoisted_19 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2"
};
var _hoisted_20 = ["value", "id"];
var _hoisted_21 = ["for"];
var _hoisted_22 = {
  "class": "row mt-3"
};
var _hoisted_23 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_24 = {
  "class": "form-select",
  id: "project_id"
};
var _hoisted_25 = ["value"];
var _hoisted_26 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_27 = {
  "class": "form-select",
  id: "city_id"
};
var _hoisted_28 = ["value", "selected"];
var _hoisted_29 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_30 = {
  "class": "form-select",
  id: "locality_id"
};
var _hoisted_31 = ["value"];
var _hoisted_32 = {
  "class": "row"
};
var _hoisted_33 = {
  "class": "col-md-5 m-b-4 mb-3"
};
var _hoisted_34 = {
  "class": "fvalue"
};
var _hoisted_35 = {
  "class": "col-md-5 m-b-4 mb-3"
};
var _hoisted_36 = {
  "class": "fvalue"
};
var _hoisted_37 = {
  "class": "row gy-2"
};
var _hoisted_38 = {
  "class": "col-md-4"
};
var _hoisted_39 = {
  "class": "input-group"
};
var _hoisted_40 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_41 = {
  "class": "fvalue"
};
var _hoisted_42 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_43 = {
  "class": "form-group"
};
var _hoisted_44 = {
  "class": "form-select",
  id: "salable_area_unit"
};
var _hoisted_45 = ["value"];
var _hoisted_46 = {
  "class": "col-md-4"
};
var _hoisted_47 = {
  "class": "input-group"
};
var _hoisted_48 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_49 = {
  "class": "fvalue"
};
var _hoisted_50 = {
  "class": "col-md-4"
};
var _hoisted_51 = {
  "class": "form-check checkbox checkbox-solid-success"
};
var _hoisted_52 = {
  "class": "row gy-2"
};
var _hoisted_53 = {
  "class": "col"
};
var _hoisted_54 = {
  "for": "add_carpet_area",
  "class": "add-input-link"
};
var _hoisted_55 = {
  key: 0,
  "for": "add_terrace_carpet_area",
  "class": "add-input-link ms-3"
};
var _hoisted_56 = {
  "class": "row gy-2 mt-1"
};
var _hoisted_57 = {
  "class": "col-md-4"
};
var _hoisted_58 = {
  "class": "input-group"
};
var _hoisted_59 = {
  "class": "form-group col-md-7"
};
var _hoisted_60 = {
  "class": "fvalue"
};
var _hoisted_61 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_62 = {
  "class": "form-group"
};
var _hoisted_63 = {
  "class": "form-select",
  id: "carpet_area_unit"
};
var _hoisted_64 = ["value"];
var _hoisted_65 = {
  "class": "col-md-4"
};
var _hoisted_66 = {
  "class": "input-group"
};
var _hoisted_67 = {
  "class": "form-group col-md-7"
};
var _hoisted_68 = {
  "class": "fvalue"
};
var _hoisted_69 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_70 = {
  "class": "form-group"
};
var _hoisted_71 = {
  "class": "form-select",
  id: "terrace_saleable_area_unit"
};
var _hoisted_72 = ["value"];
var _hoisted_73 = {
  "class": "col-md-4"
};
var _hoisted_74 = {
  "class": "input-group"
};
var _hoisted_75 = {
  "class": "form-group col-md-7"
};
var _hoisted_76 = {
  "class": "fvalue"
};
var _hoisted_77 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_78 = {
  "class": "form-group"
};
var _hoisted_79 = {
  "class": "form-select",
  id: "terrace_carpet_area_unit"
};
var _hoisted_80 = ["value"];
var _hoisted_81 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_82 = {
  "class": "col-12 col-md-2"
};
var _hoisted_83 = {
  "class": "fvalue"
};
var _hoisted_84 = {
  "class": "col-12 col-md-2"
};
var _hoisted_85 = {
  "class": "fvalue"
};
var _hoisted_86 = {
  "class": "col-12 col-md-2"
};
var _hoisted_87 = {
  "class": "fvalue"
};
var _hoisted_88 = {
  "class": "col-12 col-md-2"
};
var _hoisted_89 = {
  "class": "fvalue"
};
var _hoisted_90 = {
  "class": "col-12 col-md-2"
};
var _hoisted_91 = {
  "class": "fvalue"
};
var _hoisted_92 = {
  "class": "row mt-3"
};
var _hoisted_93 = {
  "class": "row div_checkboxes1"
};
var _hoisted_94 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_95 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_96 = {
  "class": "row mt-2"
};
var _hoisted_97 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_98 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_99 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_100 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_101 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_102 = {
  "class": "col-12 col-md-2"
};
var _hoisted_103 = {
  "class": "fvalue"
};
var _hoisted_104 = {
  "class": "col-12 col-md-2"
};
var _hoisted_105 = {
  "class": "fvalue"
};
var _hoisted_106 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_107 = {
  "class": "form-select",
  id: "source"
};
var _hoisted_108 = ["value"];
var _hoisted_109 = {
  "class": "row mt-2"
};
var _hoisted_110 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_111 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_112 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_113 = {
  key: 0,
  "class": "row mt-2"
};
var _hoisted_114 = {
  key: 0,
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_115 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_116 = ["value", "id"];
var _hoisted_117 = ["for"];
var _hoisted_118 = {
  key: 1,
  "class": "col-12 col-md-2"
};
var _hoisted_119 = {
  "class": "fvalue"
};
var _hoisted_120 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_121 = {
  "class": "col-12 col-md-7"
};
var _hoisted_122 = {
  "class": "fvalue"
};
var _hoisted_123 = {
  "class": "row mt-2"
};
var _hoisted_124 = {
  "class": "col-12 col-md-2"
};
var _hoisted_125 = ["for"];
var _hoisted_126 = {
  "class": "fvalue"
};
var _hoisted_127 = ["id", "onUpdate:modelValue"];
var _hoisted_128 = {
  "class": "col-12 col-md-2"
};
var _hoisted_129 = ["for"];
var _hoisted_130 = {
  "class": "fvalue"
};
var _hoisted_131 = ["id", "onUpdate:modelValue"];
var _hoisted_132 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_133 = ["id"];
var _hoisted_134 = {
  "class": "col-12 col-md-2"
};
var _hoisted_135 = ["for"];
var _hoisted_136 = {
  "class": "fvalue"
};
var _hoisted_137 = ["id", "onUpdate:modelValue"];
var _hoisted_138 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_139 = ["id"];
var _hoisted_140 = {
  key: 0,
  "class": "col-md-1 m-b-4 mb-4"
};
var _hoisted_141 = {
  key: 1,
  "class": "col-md-1 m-b-4 mb-4"
};
var _hoisted_142 = ["onClick"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [_cache[77] || (_cache[77] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-12 col-md-3 col-lg-2\"><div class=\"bromi-form-wizard stepwizard\"><div class=\"stepwizard-row setup-panel\"><div class=\"stepwizard-step mb-5\" style=\"text-align:initial;\"><button class=\"btn btn-primary\" id=\"step0\" data-action=\"#information-step\">1</button><p class=\"ms-2\">Information</p></div><div class=\"stepwizard-step mb-5\" style=\"text-align:initial;\"><button class=\"btn btn-light\" id=\"step1\" data-action=\"#profile-step\">2</button><p class=\"ms-2\">Property Details</p></div><div class=\"stepwizard-step\" style=\"text-align:initial;\"><button class=\"btn btn-light\" id=\"step2\" data-action=\"#unit-owner-step\">3</button><p class=\"ms-2\">Unit &amp; Contact Information</p></div></div></div></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_cache[40] || (_cache[40] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "row mb-2"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "col"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Property For")])])], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_for_type, function (propery_for, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
      key: "property_for_".concat(index),
      "class": "btn-group me-4",
      role: "group",
      "aria-label": "Basic radio toggle button group"
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "radio",
      value: propery_for.id,
      "class": "btn-check",
      name: "property_for",
      id: "property_for_".concat(index),
      autocomplete: "off",
      "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
        return $setup.data.property_for = $event;
      }),
      onChange: _cache[1] || (_cache[1] = function ($event) {
        return $setup.resetValue(1);
      })
    }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_6), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_for]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "btn btn-outline-info btn-pill btn-sm py-1",
      "for": "property_for_".concat(index)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(propery_for.name), 9 /* TEXT, PROPS */, _hoisted_7)]);
  }), 128 /* KEYED_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [_cache[37] || (_cache[37] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Property Construction Type")], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_construction_type, function (construction_type, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: "property_construction_type_".concat(index)
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: construction_type.name,
      type: "radio",
      name: "property_type",
      value: construction_type.id,
      "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
        return $setup.data.property_construction_type = $event;
      }),
      onChange: _cache[3] || (_cache[3] = function ($event) {
        return $setup.resetValue(2);
      })
    }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_10), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_construction_type]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label ms-2",
      "for": construction_type.name
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(construction_type.name), 9 /* TEXT, PROPS */, _hoisted_11)], 64 /* STABLE_FRAGMENT */);
  }), 128 /* KEYED_FRAGMENT */))])]), $setup.data.property_construction_type ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
    key: 0
  }, [_cache[38] || (_cache[38] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Category")], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_construction_type, function (construction_type, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: "first_stage_".concat(index)
    }, [$setup.data.property_construction_type == construction_type.id ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(construction_type.category, function (category, index) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
        key: "category_stage_".concat(index)
      }, [category.id != 8 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "radio",
        "class": "btn-check",
        value: category.id,
        name: "property_category",
        id: "category-".concat(category.id, "}"),
        autocomplete: "off",
        "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
          return $setup.data.property_category = $event;
        }),
        onChange: _cache[5] || (_cache[5] = function ($event) {
          return $setup.resetValue(3);
        })
      }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_14), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_category]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
        "class": "btn btn-outline-primary btn-pill btn-sm py-1",
        "for": "category-".concat(category.id, "}")
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(category.name), 9 /* TEXT, PROPS */, _hoisted_15)])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
        key: 1
      }, [$setup.data.property_for == 2 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_16, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "radio",
        "class": "btn-check",
        value: category.id,
        name: "property_category",
        id: "category-".concat(category.id, "}"),
        autocomplete: "off",
        "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
          return $setup.data.property_category = $event;
        }),
        onChange: _cache[7] || (_cache[7] = function ($event) {
          return $setup.resetValue(3);
        })
      }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_17), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_category]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
        "class": "btn btn-outline-primary btn-pill btn-sm py-1",
        "for": "category-".concat(category.id, "}")
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(category.name), 9 /* TEXT, PROPS */, _hoisted_18)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */))], 64 /* STABLE_FRAGMENT */);
    }), 128 /* KEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 128 /* KEYED_FRAGMENT */))])], 64 /* STABLE_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $setup.data.property_category && $setup.data.property_category != 8 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
    key: 1
  }, [_cache[39] || (_cache[39] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Sub Category")], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_construction_type, function (construction_type, type_index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: "first_stage_".concat(type_index)
    }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(construction_type.category, function (category, category_index) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
        key: "category_stage_".concat(category_index)
      }, [$setup.data.property_category == category.id ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
        key: 0
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(category.sub_category, function (sub_cat, sub_category_index) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
          key: "sub_category_".concat(sub_category_index),
          "class": "btn-group bromi-checkbox-btn me-1 property-type-element",
          role: "group",
          "aria-label": "Basic radio toggle button group"
        }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
          type: "radio",
          "class": "btn-check",
          value: sub_cat.id,
          name: "property_sub_category",
          id: "sub-category-".concat(sub_cat.id, "}"),
          autocomplete: "off",
          "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
            return $setup.data.property_sub_category = $event;
          })
        }, null, 8 /* PROPS */, _hoisted_20), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_sub_category]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
          "class": "btn btn-outline-primary btn-pill btn-sm py-1",
          "for": "sub-category-".concat(sub_cat.id, "}")
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(sub_cat.name), 9 /* TEXT, PROPS */, _hoisted_21)]);
      }), 128 /* KEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
    }), 128 /* KEYED_FRAGMENT */))], 64 /* STABLE_FRAGMENT */);
  }), 128 /* KEYED_FRAGMENT */))])], 64 /* STABLE_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_24, [_cache[41] || (_cache[41] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Project", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.projects, function (project) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: project.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(project.project_name), 9 /* TEXT, PROPS */, _hoisted_25);
  }), 256 /* UNKEYED_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_27, [_cache[42] || (_cache[42] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "City", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.cities, function (city, city_index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: city.id,
      selected: city_index == 0
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(city.name), 9 /* TEXT, PROPS */, _hoisted_28);
  }), 256 /* UNKEYED_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_30, [_cache[43] || (_cache[43] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Locality", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.cities, function (city) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [city.id == $setup.data.selected_city ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(city.localities, function (locality) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
        value: locality.id
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(locality.name), 9 /* TEXT, PROPS */, _hoisted_31);
    }), 256 /* UNKEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.data.address !== '' ? 'focused' : ''])
  }, [_cache[44] || (_cache[44] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "address"
  }, "Address", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "address",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.data.address = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.data.address]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.data.location_link !== '' ? 'focused' : ''])
  }, [_cache[45] || (_cache[45] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "location_link"
  }, "Location Link", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    id: "location_link",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $setup.data.location_link = $event;
    }),
    style: {
      "text-transform": "lowercase !important"
    }
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.data.location_link]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [_cache[50] || (_cache[50] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Area Size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.saleable_area !== '' ? 'focused' : ''])
  }, [_cache[46] || (_cache[46] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "saleable_area"
  }, "Salable Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "saleable_area",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.other_details.saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_44, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_45);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_47, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.ceiling_height !== '' ? 'focused' : ''])
  }, [_cache[47] || (_cache[47] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "ceiling_height"
  }, "Ceiling Height", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "ceiling_height",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $setup.other_details.ceiling_height = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.ceiling_height]])])], 2 /* CLASS */)]), _cache[48] || (_cache[48] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"input-group-append col-md-5\"><div class=\"form-group\"><select class=\"form-select\" id=\"ceiling_height_unit\"><option value=\"ft\">ft.</option><option value=\"mt\">mt.</option></select></div></div>", 1))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_51, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_terrace",
    type: "checkbox",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $setup.other_details.is_terrace = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_terrace]]), _cache[49] || (_cache[49] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_terrace"
  }, "Terrace", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_54, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_carpet_area != 1 ? '+ Add' : '- Remove') + " Carpet Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $setup.other_details.add_carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_carpet_area]]), $setup.other_details.is_terrace == 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("label", _hoisted_55, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_terrace_carpet_area != 1 ? '+ Add' : '- Remove') + " Terrace Carpet Area", 1 /* TEXT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_terrace_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $setup.other_details.add_terrace_carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_terrace_carpet_area]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.carpet_area !== '' ? 'focused' : ''])
  }, [_cache[51] || (_cache[51] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "carpet_area"
  }, "Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "carpet_area",
    "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
      return $setup.other_details.carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_63, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_64);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_carpet_area == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_66, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.terrace_saleable_area !== '' ? 'focused' : ''])
  }, [_cache[52] || (_cache[52] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "terrace_saleable_area"
  }, "Terrace Saleable Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_68, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "terrace_saleable_area",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $setup.other_details.terrace_saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.terrace_saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_71, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_72);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.is_terrace == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_74, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_75, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.terrace_carpet_area !== '' ? 'focused' : ''])
  }, [_cache[53] || (_cache[53] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "terrace_carpet_area"
  }, "Terrace Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_76, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "terrace_carpet_area",
    "onUpdate:modelValue": _cache[18] || (_cache[18] = function ($event) {
      return $setup.other_details.terrace_carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.terrace_carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_77, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_78, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_79, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_80);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_terrace_carpet_area == 1]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_81, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_82, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_project !== '' ? 'focused' : ''])
  }, [_cache[54] || (_cache[54] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_project"
  }, "Units in project", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_83, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_project",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $setup.other_details.units_in_project = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_project]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_84, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_floor !== '' ? 'focused' : ''])
  }, [_cache[55] || (_cache[55] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_floor"
  }, "Number of floor", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_85, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_floor",
    "onUpdate:modelValue": _cache[20] || (_cache[20] = function ($event) {
      return $setup.other_details.number_of_floor = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_floor]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_86, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_towers !== '' ? 'focused' : ''])
  }, [_cache[56] || (_cache[56] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_towers"
  }, "Units in towers", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_87, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_towers",
    "onUpdate:modelValue": _cache[21] || (_cache[21] = function ($event) {
      return $setup.other_details.units_in_towers = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_towers]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_88, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_on_floor !== '' ? 'focused' : ''])
  }, [_cache[57] || (_cache[57] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_on_floor"
  }, "Units on floor", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_89, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_on_floor",
    "onUpdate:modelValue": _cache[22] || (_cache[22] = function ($event) {
      return $setup.other_details.units_on_floor = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_on_floor]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_90, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_elevators !== '' ? 'focused' : ''])
  }, [_cache[58] || (_cache[58] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_elevators"
  }, "Number of elevators", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_91, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_elevators",
    "onUpdate:modelValue": _cache[23] || (_cache[23] = function ($event) {
      return $setup.other_details.number_of_elevators = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_elevators]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_92, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_93, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_94, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "service_elevator",
    type: "checkbox",
    "onUpdate:modelValue": _cache[24] || (_cache[24] = function ($event) {
      return $setup.other_details.service_elevator = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.service_elevator]]), _cache[59] || (_cache[59] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "service_elevator"
  }, "Service Elevator", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_hot",
    type: "checkbox",
    "onUpdate:modelValue": _cache[25] || (_cache[25] = function ($event) {
      return $setup.other_details.is_hot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_hot]]), _cache[60] || (_cache[60] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_hot"
  }, "Hot", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_96, [_cache[64] || (_cache[64] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Washrooms", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_97, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_98, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Private Washrooms",
    name: "washrooms",
    id: "private_washroom",
    "onUpdate:modelValue": _cache[26] || (_cache[26] = function ($event) {
      return $setup.other_details.washrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.washrooms]]), _cache[61] || (_cache[61] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "private_washroom"
  }, "Private Washrooms", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_99, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Public Washrooms",
    name: "washrooms",
    id: "public_washroom",
    "onUpdate:modelValue": _cache[27] || (_cache[27] = function ($event) {
      return $setup.other_details.washrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.washrooms]]), _cache[62] || (_cache[62] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "public_washroom"
  }, "Public Washrooms", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_100, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Not Available",
    name: "washrooms",
    id: "not_available",
    "onUpdate:modelValue": _cache[28] || (_cache[28] = function ($event) {
      return $setup.other_details.washrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.washrooms]]), _cache[63] || (_cache[63] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "not_available"
  }, "Not Available", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_101, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_102, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.four_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[65] || (_cache[65] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "four_wheeler_parking"
  }, "Four wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_103, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "four_wheeler_parking",
    "onUpdate:modelValue": _cache[29] || (_cache[29] = function ($event) {
      return $setup.other_details.four_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.four_wheeler_parking]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_104, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.two_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[66] || (_cache[66] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "two_wheeler_parking"
  }, "Two wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_105, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "two_wheeler_parking",
    "onUpdate:modelValue": _cache[30] || (_cache[30] = function ($event) {
      return $setup.other_details.two_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.two_wheeler_parking]])])], 2 /* CLASS */)]), _cache[68] || (_cache[68] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"priority\"><option value=\"\">Priority</option><option value=\"High\">High</option><option value=\"Medium\">Medium</option><option value=\"Low\">Low</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_106, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_107, [_cache[67] || (_cache[67] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Source", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_source, function (source) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: source.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(source.name), 9 /* TEXT, PROPS */, _hoisted_108);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_109, [_cache[71] || (_cache[71] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Availability Status", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_110, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_111, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Available",
    name: "availability_status",
    id: "available",
    "onUpdate:modelValue": _cache[31] || (_cache[31] = function ($event) {
      return $setup.other_details.availability_status = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[69] || (_cache[69] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "available"
  }, "Available", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_112, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Under Construction",
    name: "availability_status",
    id: "under_con",
    "onUpdate:modelValue": _cache[32] || (_cache[32] = function ($event) {
      return $setup.other_details.availability_status = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[70] || (_cache[70] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "under_con"
  }, "Under Construction", -1 /* HOISTED */))])])]), $setup.other_details.availability_status ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_113, [$setup.other_details.availability_status == 'Available' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_114, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.age_of_property, function (age) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_115, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "radio",
      "class": "btn-check",
      value: age,
      name: "age_of_property",
      id: "age-".concat(age),
      "onUpdate:modelValue": _cache[33] || (_cache[33] = function ($event) {
        return $setup.other_details.age_of_property = $event;
      })
    }, null, 8 /* PROPS */, _hoisted_116), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.age_of_property]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "btn btn-outline-primary btn-pill btn-sm py-1",
      "for": "age-".concat(age)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(age), 9 /* TEXT, PROPS */, _hoisted_117)]);
  }), 64 /* STABLE_FRAGMENT */))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $setup.other_details.availability_status == 'Under Construction' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_118, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.available_from !== '' ? 'focused' : ''])
  }, [_cache[72] || (_cache[72] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "available_from"
  }, "Available From", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_119, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "available_from",
    "onUpdate:modelValue": _cache[34] || (_cache[34] = function ($event) {
      return $setup.other_details.available_from = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.available_from]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_120, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_121, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.remark !== '' ? 'focused' : ''])
  }, [_cache[73] || (_cache[73] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "remark"
  }, "Property Remark", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_122, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "remark",
    "onUpdate:modelValue": _cache[35] || (_cache[35] = function ($event) {
      return $setup.other_details.remark = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.remark]])])], 2 /* CLASS */)])]), _cache[76] || (_cache[76] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "row mt-3"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Unit Details")], -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.unit_details, function (unit, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_123, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_124, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.wing !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_wing_".concat(index)
    }, "Wing", 8 /* PROPS */, _hoisted_125), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_126, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_wing_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.wing = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_127), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.wing]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_128, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.unit_number !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_unit_number_".concat(index)
    }, "Unit No", 8 /* PROPS */, _hoisted_129), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_130, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_unit_number_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.wing = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_131), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.wing]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_132, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "class": "form-select",
      id: "unit_available_".concat(index)
    }, _toConsumableArray(_cache[74] || (_cache[74] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
      value: ""
    }, "Available", -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
      value: "Rent Out"
    }, "Rent Out", -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
      value: "Sold Sout"
    }, "Sold Out", -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_133)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_134, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.price_rent !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_price_rent_".concat(index)
    }, "Price Rent", 8 /* PROPS */, _hoisted_135), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_136, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_price_rent_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.price_rent = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_137), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.price_rent]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_138, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "class": "form-select",
      id: "furnished_status_".concat(index)
    }, _toConsumableArray(_cache[75] || (_cache[75] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<option value=\"\">Furnished Status</option><option value=\"Furnished\">Furnished</option><option value=\"Semi Furnished\">Semi Furnished</option><option value=\"Unfurnished\">Unfurnished</option><option value=\"Can Furnished\">Can Furnished</option>", 5)])), 8 /* PROPS */, _hoisted_139)]), index == 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_140, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      type: "button",
      onClick: _cache[36] || (_cache[36] = function ($event) {
        return $setup.addUnit();
      })
    }, "+")])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_141, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-danger",
      type: "button",
      onClick: function onClick($event) {
        return $setup.removeUnit(index);
      }
    }, "-", 8 /* PROPS */, _hoisted_142)]))]);
  }), 256 /* UNKEYED_FRAGMENT */))])]);
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/exportHelper.js":
/*!******************************************************!*\
  !*** ./node_modules/vue-loader/dist/exportHelper.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, exports) => {


Object.defineProperty(exports, "__esModule", ({ value: true }));
// runtime helper for setting properties on components
// in a tree-shakable way
exports["default"] = (sfc, props) => {
    const target = sfc.__vccOpts || sfc;
    for (const [key, val] of props) {
        target[key] = val;
    }
    return target;
};


/***/ }),

/***/ "./resources/js/Components/Property/AddForm.vue":
/*!******************************************************!*\
  !*** ./resources/js/Components/Property/AddForm.vue ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _AddForm_vue_vue_type_template_id_47c9e914__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AddForm.vue?vue&type=template&id=47c9e914 */ "./resources/js/Components/Property/AddForm.vue?vue&type=template&id=47c9e914");
/* harmony import */ var _AddForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AddForm.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/AddForm.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_AddForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_AddForm_vue_vue_type_template_id_47c9e914__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/AddForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/AddForm.vue?vue&type=script&setup=true&lang=js":
/*!*****************************************************************************************!*\
  !*** ./resources/js/Components/Property/AddForm.vue?vue&type=script&setup=true&lang=js ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AddForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AddForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AddForm.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/AddForm.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/AddForm.vue?vue&type=template&id=47c9e914":
/*!************************************************************************************!*\
  !*** ./resources/js/Components/Property/AddForm.vue?vue&type=template&id=47c9e914 ***!
  \************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AddForm_vue_vue_type_template_id_47c9e914__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AddForm_vue_vue_type_template_id_47c9e914__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AddForm.vue?vue&type=template&id=47c9e914 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/AddForm.vue?vue&type=template&id=47c9e914");


/***/ })

}]);