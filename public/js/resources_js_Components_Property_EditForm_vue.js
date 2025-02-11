"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Components_Property_EditForm_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/EditForm.vue?vue&type=script&setup=true&lang=js":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/EditForm.vue?vue&type=script&setup=true&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _UpdateForms_officeRetailForm_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./UpdateForms/officeRetailForm.vue */ "./resources/js/Components/Property/UpdateForms/officeRetailForm.vue");
/* harmony import */ var _UpdateForms_storageIndustrialForm_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./UpdateForms/storageIndustrialForm.vue */ "./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue");
/* harmony import */ var _UpdateForms_LandForm_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./UpdateForms/LandForm.vue */ "./resources/js/Components/Property/UpdateForms/LandForm.vue");
/* harmony import */ var _UpdateForms_flatForm_vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./UpdateForms/flatForm.vue */ "./resources/js/Components/Property/UpdateForms/flatForm.vue");
/* harmony import */ var _UpdateForms_VilaBanglow_vue__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./UpdateForms/VilaBanglow.vue */ "./resources/js/Components/Property/UpdateForms/VilaBanglow.vue");
/* harmony import */ var _UpdateForms_PenthouseForm_vue__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./UpdateForms/PenthouseForm.vue */ "./resources/js/Components/Property/UpdateForms/PenthouseForm.vue");
/* harmony import */ var _UpdateForms_PlotForm_vue__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./UpdateForms/PlotForm.vue */ "./resources/js/Components/Property/UpdateForms/PlotForm.vue");
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }









/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'EditForm',
  props: ['property_master', 'property_for_type', 'property_construction_type', 'projects', 'cities', 'authuser', 'land_units', 'property_source', 'country_codes', 'districts', 'property_zones', 'amenities'],
  setup: function setup(__props, _ref) {
    var _props$property_maste, _props$property_maste2, _props$property_maste3, _props$property_maste4, _props$property_maste5, _props$property_maste6, _props$property_maste7, _props$property_maste8, _props$property_maste9, _props$property_maste10, _props$property_maste11, _props$property_maste12, _props$property_maste13;
    var __expose = _ref.expose;
    __expose();
    var office_retail_form = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var storage_industrial_form = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var land_form = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var flat_form = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var villa_banglow_form = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var penthouse_form = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var plot_form = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var files = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)({
      images: null,
      documents: null
    });
    var formData = new FormData();
    var props = __props;
    var data = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'property_for': props.property_master.property_for,
      'property_construction_type': props.property_master.property_contruction_type_id,
      'property_category': props.property_master.category_id,
      'property_sub_category': props.property_master.sub_category_id,
      'selected_project': props.property_master.project_id,
      'selected_city': props.property_master.city_id,
      'selected_locality': props.property_master.area_id,
      'selected_district': props.property_master.district_id,
      'selected_taluka': props.property_master.taluka_id,
      'selected_village': props.property_master.village_id,
      'selected_zone': props.property_master.zone_id,
      'address': props.property_master.address,
      'location_link': props.property_master.location_link
    });
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'survey_number': props.property_master.survey_number,
      'survey_plot_size': props.property_master.survey_plot_size,
      'survey_plot_size_unit': props.property_master.survey_plot_size_unit,
      'survey_price': props.property_master.survey_price,
      'tp_number': props.property_master.tp_number,
      'fp_number': props.property_master.fp_number,
      'tp_plot_size': props.property_master.tp_plot_size,
      'tp_plot_size_unit': props.property_master.tp_plot_size_unit,
      'tp_price': props.property_master.tp_price,
      'owner_type': (_props$property_maste = (_props$property_maste2 = props.property_master.owner_info) === null || _props$property_maste2 === void 0 ? void 0 : _props$property_maste2.type) !== null && _props$property_maste !== void 0 ? _props$property_maste : '',
      'owner_name': (_props$property_maste3 = (_props$property_maste4 = props.property_master.owner_info) === null || _props$property_maste4 === void 0 ? void 0 : _props$property_maste4.name) !== null && _props$property_maste3 !== void 0 ? _props$property_maste3 : '',
      'owner_contact_code': (_props$property_maste5 = (_props$property_maste6 = props.property_master.owner_info) === null || _props$property_maste6 === void 0 ? void 0 : _props$property_maste6.country_code) !== null && _props$property_maste5 !== void 0 ? _props$property_maste5 : '',
      'owner_contact': (_props$property_maste7 = props.property_master.owner_info) === null || _props$property_maste7 === void 0 ? void 0 : _props$property_maste7.contact,
      'owner_email': (_props$property_maste8 = (_props$property_maste9 = props.property_master.owner_info) === null || _props$property_maste9 === void 0 ? void 0 : _props$property_maste9.email) !== null && _props$property_maste8 !== void 0 ? _props$property_maste8 : '',
      'is_nri': (_props$property_maste10 = (_props$property_maste11 = props.property_master.owner_info) === null || _props$property_maste11 === void 0 ? void 0 : _props$property_maste11.is_nri) !== null && _props$property_maste10 !== void 0 ? _props$property_maste10 : '',
      'key_available_at': props.property_master.key_available_at
    });
    var unit_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)((_props$property_maste12 = props.property_master.unit_details) === null || _props$property_maste12 === void 0 ? void 0 : _props$property_maste12.map(function (unit) {
      return {
        'id': unit.id,
        'wing': unit.wing,
        'unit_number': unit.unit_no,
        'available': null,
        // 'available': unit.availability_status ? unitavailabilityStatus[unit.availability_status] : null,
        'price_rent': unit.price_rent,
        'price': unit.price,
        'terrace_price': unit.terrace_price,
        'flat_price': unit.flat_price,
        'construction_price': unit.construction_price,
        'plot_price': unit.plot_price,
        'furnished_status': unit.furniture_status,
        'no_of_seats': unit.no_of_seats,
        'no_of_cabins': unit.no_of_cabins,
        'no_of_conference_room': unit.no_of_conference_room,
        'remark': unit.remark,
        'facilities': unit.facilities,
        'furniture_total': unit.furniture_total
      };
    }));
    var other_contact_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)((_props$property_maste13 = props.property_master.contact_details) === null || _props$property_maste13 === void 0 ? void 0 : _props$property_maste13.map(function (contact) {
      return {
        'name': contact.name,
        'contact_code': contact.country_code,
        'contact': contact.contact_no,
        'position': contact.position
      };
    }));
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      initializeSelect2();
      prefillForm();
      if (props.property_master.unit_details.length == 0) {
        addUnit();
      }
      if (props.property_master.contact_details.length == 0) {
        addContact();
      }
    });
    function initializeSelect2() {
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
      $('#district_id').select2().on('change', function () {
        data.selected_district = $(this).val();
      });
      $('#taluka_id').select2().on('change', function () {
        data.selected_taluka = $(this).val();
      });
      $('#village_id').select2().on('change', function () {
        data.selected_village = $(this).val();
      });
      $('#zone_id').select2().on('change', function () {
        data.selected_zone = $(this).val();
      });
      $('#owner_type').select2().on('change', function () {
        other_details.owner_type = $(this).val();
      });
      $('#survey_plot_size_unit').select2().on('change', function () {
        other_details.survey_plot_size_unit = $(this).val();
        setMainUnits($(this).val());
      });
      $('#tp_plot_size_unit').select2().on('change', function () {
        other_details.tp_plot_size_unit = $(this).val();
        setMainUnits($(this).val());
      });
      $('#owner_contact_code').select2().on('change', function () {
        other_details.owner_contact_code = $(this).val();
      });
      $('#key_available_at').select2().on('change', function () {
        other_details.key_available_at = $(this).val();
      });
      unitDetailsSelect2();
      otherContactSelect2();
    }
    function prefillForm() {
      var _props$property_maste14, _props$property_maste15, _props$property_maste16, _props$property_maste17;
      $("#project_id").val(props.property_master.project_id).trigger('change');
      $("#city_id").val(props.property_master.city_id).trigger('change');
      $("#locality_id").val(props.property_master.area_id).trigger('change');
      $("#district_id").val(props.property_master.district_id).trigger('change');
      $("#taluka_id").val(props.property_master.taluka_id).trigger('change');
      $("#village_id").val(props.property_master.village_id).trigger('change');
      $("#zone_id").val(props.property_master.zone_id).trigger('change');
      $("#owner_type").val((_props$property_maste14 = (_props$property_maste15 = props.property_master.owner_info) === null || _props$property_maste15 === void 0 ? void 0 : _props$property_maste15.type) !== null && _props$property_maste14 !== void 0 ? _props$property_maste14 : '').trigger('change');
      $("#survey_plot_size_unit").val(props.property_master.survey_plot_size_unit).trigger('change');
      $("#tp_plot_size_unit").val(props.property_master.tp_plot_size_unit).trigger('change');
      $("#owner_contact_code").val((_props$property_maste16 = (_props$property_maste17 = props.property_master.owner_info) === null || _props$property_maste17 === void 0 ? void 0 : _props$property_maste17.country_code) !== null && _props$property_maste16 !== void 0 ? _props$property_maste16 : '').trigger('change');
      $("#key_available_at").val(props.property_master.key_available_at).trigger('change');
      if (props.property_master.unit_details.length > 0) {
        props.property_master.unit_details.forEach(function (unit, index) {
          switch (unit.availability_status) {
            case 1:
              unit_details[index].available = 'Rent Out';
              $("#unit_available_".concat(index)).val('Rent Out').trigger('change');
              break;
            case 2:
              unit_details[index].available = 'Sold Out';
              $("#unit_available_".concat(index)).val('Sold Out').trigger('change');
              break;
            default:
              unit_details[index].available = '';
              $("#unit_available_".concat(index)).val('').trigger('change');
              break;
          }
          $("#furnished_status_".concat(index)).val(unit.furniture_status).trigger('change');
        });
      }
      if (props.property_master.contact_details.length > 0) {
        props.property_master.contact_details.forEach(function (contact, index) {
          other_contact_details[index].contact_code = contact.country_code;
          $("#contact_code_".concat(index)).val(other_contact_details[index].contact_code).trigger('change');
        });
      }
    }
    function unitDetailsSelect2() {
      var _props$property_maste18;
      (_props$property_maste18 = props.property_master.unit_details) === null || _props$property_maste18 === void 0 || _props$property_maste18.forEach(function (unit_detail, index) {
        $("#unit_available_".concat(index)).select2().on('change', function () {
          unit_details[index].available = $(this).val();
        });
        $("#furnished_status_".concat(index)).select2().on('change', function () {
          unit_details[index].furnished_status = $(this).val();
          unit_details[index]['no_of_seats'] = '';
          unit_details[index]['no_of_cabins'] = '';
          unit_details[index]['no_of_conference_room'] = '';
          unit_details[index]['remark'] = '';
          unit_details[index]['facilities'] = [];
        });
      });
    }
    function addUnit() {
      unit_details.push({
        'id': '',
        'wing': '',
        'unit_number': '',
        'available': '',
        'price_rent': '',
        'price': '',
        'construction_price': '',
        'plot_price': '',
        'furnished_status': '',
        'no_of_seats': '',
        'no_of_cabins': '',
        'no_of_conference_room': '',
        'remark': '',
        'facilities': [],
        'furniture_total': {
          'light': 0,
          'ac': 0,
          'beds': 0,
          'geyser': 0,
          'fans': 0,
          'tv': 0,
          'wardobe': 0,
          'sofa': 0
        }
      });
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.nextTick)(function () {
        unitDetailsSelect2();
      });
    }
    function removeUnit(index) {
      unit_details.splice(index, 1);
    }
    function otherContactSelect2() {
      var _props$property_maste19;
      (_props$property_maste19 = props.property_master.contact_details) === null || _props$property_maste19 === void 0 || _props$property_maste19.forEach(function (unit_detail, index) {
        $("#contact_code_".concat(index)).select2().on('change', function () {
          other_contact_details[index].contact_code = $(this).val();
        });
      });
    }
    function addContact() {
      other_contact_details.push({
        'name': '',
        'contact_code': '',
        'contact': '',
        'position': ''
      });
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.nextTick)(function () {
        otherContactSelect2();
      });
    }
    function removeContact(index) {
      other_contact_details.splice(index, 1);
    }
    function resetValue(clicked_value) {
      if (data.property_category == 8) {
        if (clicked_value == 1) {
          data.property_construction_type = null;
        }
        if (clicked_value == 1 || clicked_value == 2) {
          data.property_category = null;
        }
        data.property_sub_category = null;
      }
    }
    var isUpdatingMainUnit = false;
    function setMainUnits(value) {
      if (isUpdatingMainUnit) return;
      isUpdatingMainUnit = true;
      var input_array = ['survey_plot_size_unit', 'tp_plot_size_unit'];
      input_array === null || input_array === void 0 || input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingMainUnit = false;
      }, 0);
    }
    function appendFormData(data) {
      var parentKey = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
      Object.keys(data).forEach(function (key) {
        var fullKey = parentKey ? "".concat(parentKey, "[").concat(key, "]") : key;
        var value = data[key];
        if (value instanceof File) {
          formData.append(fullKey, value);
        } else if (_typeof(value) === "object" && value !== null) {
          appendFormData(value, fullKey);
        } else {
          formData.append(fullKey, value !== null && value !== void 0 ? value : "");
        }
      });
    }
    function submitForm() {
      var post_data = {
        'basic_detail': data,
        'other_details': other_details,
        'unit_details': unit_details,
        'other_contact_details': other_contact_details
      };
      if ([1, 2].includes(data.property_category)) {
        var office_retail_data = office_retail_form.value.getData();
        post_data.other_details = _objectSpread(_objectSpread({}, post_data.other_details), office_retail_data);
      }
      if (data.property_category == 3) {
        var storage_industrial_data = storage_industrial_form.value.getData();
        post_data.other_details = _objectSpread(_objectSpread({}, post_data.other_details), storage_industrial_data);
      }
      if (data.property_category == 4) {
        var land_data = land_form.value.getData();
        post_data.other_details = _objectSpread(_objectSpread({}, post_data.other_details), land_data);
      }
      if (data.property_category == 5) {
        var flat_data = flat_form.value.getData();
        post_data.other_details = _objectSpread(_objectSpread({}, post_data.other_details), flat_data);
      }
      if (data.property_category == 6) {
        var villa_banglow_data = villa_banglow_form.value.getData();
        post_data.other_details = _objectSpread(_objectSpread({}, post_data.other_details), villa_banglow_data);
      }
      if (data.property_category == 7) {
        var penthouse_form_data = penthouse_form.value.getData();
        post_data.other_details = _objectSpread(_objectSpread({}, post_data.other_details), penthouse_form_data);
      }
      if (data.property_category == 8) {
        var plot_form_data = plot_form.value.getData();
        post_data.other_details = _objectSpread(_objectSpread({}, post_data.other_details), plot_form_data);
      }
      appendFormData(post_data);
      appendFormData(files.value);
      axios__WEBPACK_IMPORTED_MODULE_1___default().post("/admin/master-properties/update-property/".concat(props.property_master.id), formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      }).then(function (response) {
        window.location.reload();
        // window.location.href = "/admin/master-properties/index";
      })["catch"](function (error) {
        console.error(error);
      });
    }
    function handleFileUpload(type, event) {
      if (event.target.files.length == 0) return;
      if (type == 'image') {
        files.value.images = event.target.files;
      }
      if (type == 'document') {
        files.value.documents = event.target.files;
      }
    }
    var __returned__ = {
      get office_retail_form() {
        return office_retail_form;
      },
      set office_retail_form(v) {
        office_retail_form = v;
      },
      get storage_industrial_form() {
        return storage_industrial_form;
      },
      set storage_industrial_form(v) {
        storage_industrial_form = v;
      },
      get land_form() {
        return land_form;
      },
      set land_form(v) {
        land_form = v;
      },
      get flat_form() {
        return flat_form;
      },
      set flat_form(v) {
        flat_form = v;
      },
      get villa_banglow_form() {
        return villa_banglow_form;
      },
      set villa_banglow_form(v) {
        villa_banglow_form = v;
      },
      get penthouse_form() {
        return penthouse_form;
      },
      set penthouse_form(v) {
        penthouse_form = v;
      },
      get plot_form() {
        return plot_form;
      },
      set plot_form(v) {
        plot_form = v;
      },
      get files() {
        return files;
      },
      set files(v) {
        files = v;
      },
      get formData() {
        return formData;
      },
      set formData(v) {
        formData = v;
      },
      props: props,
      data: data,
      other_details: other_details,
      unit_details: unit_details,
      other_contact_details: other_contact_details,
      initializeSelect2: initializeSelect2,
      prefillForm: prefillForm,
      unitDetailsSelect2: unitDetailsSelect2,
      addUnit: addUnit,
      removeUnit: removeUnit,
      otherContactSelect2: otherContactSelect2,
      addContact: addContact,
      removeContact: removeContact,
      resetValue: resetValue,
      get isUpdatingMainUnit() {
        return isUpdatingMainUnit;
      },
      set isUpdatingMainUnit(v) {
        isUpdatingMainUnit = v;
      },
      setMainUnits: setMainUnits,
      appendFormData: appendFormData,
      submitForm: submitForm,
      handleFileUpload: handleFileUpload,
      reactive: vue__WEBPACK_IMPORTED_MODULE_0__.reactive,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_0__.onMounted,
      nextTick: vue__WEBPACK_IMPORTED_MODULE_0__.nextTick,
      ref: vue__WEBPACK_IMPORTED_MODULE_0__.ref,
      get axios() {
        return (axios__WEBPACK_IMPORTED_MODULE_1___default());
      },
      officeRetailForm: _UpdateForms_officeRetailForm_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
      storageIndustrialForm: _UpdateForms_storageIndustrialForm_vue__WEBPACK_IMPORTED_MODULE_3__["default"],
      landForm: _UpdateForms_LandForm_vue__WEBPACK_IMPORTED_MODULE_4__["default"],
      flatForm: _UpdateForms_flatForm_vue__WEBPACK_IMPORTED_MODULE_5__["default"],
      vilaBanglowForm: _UpdateForms_VilaBanglow_vue__WEBPACK_IMPORTED_MODULE_6__["default"],
      penthouseForm: _UpdateForms_PenthouseForm_vue__WEBPACK_IMPORTED_MODULE_7__["default"],
      PlotForm: _UpdateForms_PlotForm_vue__WEBPACK_IMPORTED_MODULE_8__["default"]
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=script&setup=true&lang=js":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=script&setup=true&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'LandForm',
  props: ['land_units', 'property_source', 'property_category'],
  setup: function setup(__props, _ref) {
    var __expose = _ref.expose;
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      $('#length_of_plot_unit').select2().on('change', function () {
        other_details.length_of_plot_unit = $(this).val();
        setOtherUnits($(this).val());
      });
      $('#width_of_plot_unit').select2().on('change', function () {
        other_details.width_of_plot_unit = $(this).val();
        setOtherUnits($(this).val());
      });
      $('#road_width_of_front_side_unit').select2().on('change', function () {
        other_details.road_width_of_front_side_unit = $(this).val();
        setOtherUnits($(this).val());
      });
      $('#construction_allowed_for').select2().on('change', function () {
        other_details.construction_allowed_for = $(this).val();
      });
      $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
      });
      $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
      });
      documentSelect2(); // for documents

      $('.select2-hidden-accessible').each(function () {
        var select2Instance = $(this).data('select2');
        if (select2Instance) {
          var options = $(this).children('option');
          select2Instance.trigger('select', {
            data: {
              id: options.eq(0).val(),
              text: options.eq(0).text()
            }
          });
        }
      });
    });
    var props = __props;
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'length_of_plot': '',
      'length_of_plot_unit': '',
      'width_of_plot': '',
      'width_of_plot_unit': '',
      'number_of_floors_allowed': '',
      'road_width_of_front_side': '',
      'road_width_of_front_side_unit': '',
      'construction_allowed_for': '',
      'fsi_far': '',
      'priority': '',
      'source': '',
      'remark': ''
    });
    var construction_docs = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)([{
      'category': '',
      'file': ''
    }]);
    function documentSelect2() {
      construction_docs.forEach(function (document, index) {
        $("#document_category_".concat(index)).select2().on('change', function () {
          construction_docs[index].category = $(this).val();
        });
      });
    }
    function addDoc() {
      construction_docs.push({
        'category': '',
        'file': ''
      });
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.nextTick)(function () {
        documentSelect2();
      });
    }
    function removeDoc(index) {
      construction_docs.splice(index, 1);
    }
    var isUpdatingOtherUnit = false;
    function setOtherUnits(value) {
      if (isUpdatingOtherUnit) return;
      isUpdatingOtherUnit = true;
      var input_array = ['length_of_plot_unit', 'width_of_plot_unit', 'road_width_of_front_side_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingOtherUnit = false;
      }, 0);
    }
    function getData() {
      return _objectSpread(_objectSpread({}, other_details), {}, {
        construction_docs: _objectSpread({}, construction_docs)
      });
    }
    function handleFileUpload(event, index) {
      construction_docs[index].file = event.target.files[0];
    }
    __expose({
      getData: getData
    });
    var __returned__ = {
      props: props,
      other_details: other_details,
      get construction_docs() {
        return construction_docs;
      },
      set construction_docs(v) {
        construction_docs = v;
      },
      documentSelect2: documentSelect2,
      addDoc: addDoc,
      removeDoc: removeDoc,
      get isUpdatingOtherUnit() {
        return isUpdatingOtherUnit;
      },
      set isUpdatingOtherUnit(v) {
        isUpdatingOtherUnit = v;
      },
      setOtherUnits: setOtherUnits,
      getData: getData,
      handleFileUpload: handleFileUpload,
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

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=script&setup=true&lang=js":
/*!***************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=script&setup=true&lang=js ***!
  \***************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'PenthouseForm',
  props: ['land_units', 'property_source', 'property_category', 'amenities'],
  setup: function setup(__props, _ref) {
    var __expose = _ref.expose;
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      $('#saleable_area_unit').select2().on('change', function () {
        other_details.saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#terrace_saleable_area_unit').select2().on('change', function () {
        other_details.terrace_saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#carpet_area_unit').select2().on('change', function () {
        other_details.carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#built_area_unit').select2().on('change', function () {
        other_details.built_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#terrace_carpet_area_unit').select2().on('change', function () {
        other_details.terrace_carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
      });
      $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
      });
    });
    var props = __props;
    var age_of_property = ['0-1 Years', '1-5 Years', '5-10 Years', '10+ Years'];
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'saleable_area': '',
      'saleable_area_unit': '',
      'terrace_saleable_area': '',
      'terrace_saleable_area_unit': '',
      'add_carpet_area': '',
      'carpet_area': '',
      'carpet_area_unit': '',
      'add_builtup_area': '',
      'built_area': '',
      'built_area_unit': '',
      'add_terrace_carpet_area': '',
      'terrace_carpet_area': '',
      'terrace_carpet_area_unit': '',
      'units_in_project': '',
      'number_of_floor': '',
      'units_in_towers': '',
      'units_on_floor': '',
      'number_of_elevators': '',
      'number_of_balcony': '',
      'number_of_bathrooms': '',
      'service_elevator': '',
      'servent_room': '',
      'is_hot': '',
      'four_wheeler_parking': '',
      'two_wheeler_parking': '',
      'priority': '',
      'source': '',
      'availability_status': '',
      'age_of_property': '',
      'available_from': '',
      'remark': '',
      'is_have_amenities': false,
      'amenities': props.amenities.reduce(function (acc, el) {
        return _objectSpread(_objectSpread({}, acc), {}, _defineProperty({}, el.id, false));
      }, {})
    });
    function resetValue(array) {
      array.forEach(function (element) {
        other_details[element] = '';
      });
    }
    var isUpdatingMainUnit = false;
    function setSameMainUnits(value) {
      if (isUpdatingMainUnit) return;
      isUpdatingMainUnit = true;
      var input_array = ['saleable_area_unit', 'terrace_saleable_area_unit', 'carpet_area_unit', 'built_area_unit', 'terrace_carpet_area_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingMainUnit = false;
      }, 0);
    }
    function getData() {
      return other_details;
    }
    __expose({
      getData: getData
    });
    var __returned__ = {
      props: props,
      age_of_property: age_of_property,
      other_details: other_details,
      resetValue: resetValue,
      get isUpdatingMainUnit() {
        return isUpdatingMainUnit;
      },
      set isUpdatingMainUnit(v) {
        isUpdatingMainUnit = v;
      },
      setSameMainUnits: setSameMainUnits,
      getData: getData,
      reactive: vue__WEBPACK_IMPORTED_MODULE_0__.reactive,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_0__.onMounted
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=script&setup=true&lang=js":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=script&setup=true&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'PlotForm',
  props: ['land_units', 'property_source', 'property_category'],
  setup: function setup(__props, _ref) {
    var __expose = _ref.expose;
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      $('#saleable_area_unit').select2().on('change', function () {
        other_details.saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#length_of_plot_unit').select2().on('change', function () {
        other_details.length_of_plot_unit = $(this).val();
        setOtherUnits($(this).val());
      });
      $('#width_of_plot_unit').select2().on('change', function () {
        other_details.width_of_plot_unit = $(this).val();
        setOtherUnits($(this).val());
      });
      $('#carpet_plot_area_unit').select2().on('change', function () {
        other_details.carpet_plot_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
      });
      $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
      });
    });
    var props = __props;
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'saleable_area': '',
      'saleable_area_unit': '',
      'length_of_plot': '',
      'length_of_plot_unit': '',
      'width_of_plot': '',
      'width_of_plot_unit': '',
      'add_carpet_plot_area': '',
      'carpet_plot_area': '',
      'carpet_plot_area_unit': '',
      'number_of_units': '',
      'number_of_floors_allowed': '',
      'number_of_open_side': '',
      'is_hot': '',
      'priority': '',
      'source': '',
      'remark': ''
    });
    function resetValue(array) {
      array.forEach(function (element) {
        other_details[element] = '';
      });
    }
    var isUpdatingMainUnit = false;
    function setSameMainUnits(value) {
      if (isUpdatingMainUnit) return;
      isUpdatingMainUnit = true;
      var input_array = ['saleable_area_unit', 'carpet_plot_area_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingMainUnit = false;
      }, 0);
    }
    var isUpdatingOtherUnit = false;
    function setOtherUnits(value) {
      if (isUpdatingOtherUnit) return;
      isUpdatingOtherUnit = true;
      var input_array = ['length_of_plot_unit', 'width_of_plot_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingOtherUnit = false;
      }, 0);
    }
    function getData() {
      return other_details;
    }
    __expose({
      getData: getData
    });
    var __returned__ = {
      props: props,
      other_details: other_details,
      resetValue: resetValue,
      get isUpdatingMainUnit() {
        return isUpdatingMainUnit;
      },
      set isUpdatingMainUnit(v) {
        isUpdatingMainUnit = v;
      },
      setSameMainUnits: setSameMainUnits,
      get isUpdatingOtherUnit() {
        return isUpdatingOtherUnit;
      },
      set isUpdatingOtherUnit(v) {
        isUpdatingOtherUnit = v;
      },
      setOtherUnits: setOtherUnits,
      getData: getData,
      reactive: vue__WEBPACK_IMPORTED_MODULE_0__.reactive,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_0__.onMounted
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=script&setup=true&lang=js":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=script&setup=true&lang=js ***!
  \*************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'VilaBanglow',
  props: ['land_units', 'property_source', 'property_category', 'amenities'],
  setup: function setup(__props, _ref) {
    var __expose = _ref.expose;
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      $('#saleable_plot_area_unit').select2().on('change', function () {
        other_details.saleable_plot_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#saleable_constructed_area_unit').select2().on('change', function () {
        other_details.saleable_constructed_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#carpet_plot_area_unit').select2().on('change', function () {
        other_details.carpet_plot_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#constructed_carpet_area_unit').select2().on('change', function () {
        other_details.constructed_carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#constructed_builtup_area_unit').select2().on('change', function () {
        other_details.constructed_builtup_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
      });
      $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
      });
    });
    var props = __props;
    var age_of_property = ['0-1 Years', '1-5 Years', '5-10 Years', '10+ Years'];
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'saleable_plot_area': '',
      'saleable_plot_area_unit': '',
      'saleable_constructed_area': '',
      'saleable_constructed_area_unit': '',
      'add_carpet_plot_area': '',
      'carpet_plot_area': '',
      'carpet_plot_area_unit': '',
      'add_constructed_carpet_area': '',
      'constructed_carpet_area': '',
      'constructed_carpet_area_unit': '',
      'add_constructed_builtup_area': '',
      'constructed_builtup_area': '',
      'constructed_builtup_area_unit': '',
      'number_of_balcony': '',
      'number_of_units': '',
      'number_of_bathrooms': '',
      'number_of_open_side': '',
      'servent_room': '',
      'is_hot': '',
      'weekend': '',
      'four_wheeler_parking': '',
      'two_wheeler_parking': '',
      'priority': '',
      'source': '',
      'availability_status': '',
      'age_of_property': '',
      'available_from': '',
      'remark': '',
      'is_have_amenities': false,
      'amenities': props.amenities.reduce(function (acc, el) {
        return _objectSpread(_objectSpread({}, acc), {}, _defineProperty({}, el.id, false));
      }, {})
    });
    function resetValue(array) {
      array.forEach(function (element) {
        other_details[element] = '';
      });
    }
    var isUpdatingMainUnit = false;
    function setSameMainUnits(value) {
      if (isUpdatingMainUnit) return;
      isUpdatingMainUnit = true;
      var input_array = ['saleable_plot_area_unit', 'saleable_constructed_area_unit', 'carpet_plot_area_unit', 'constructed_carpet_area_unit', 'constructed_builtup_area_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingMainUnit = false;
      }, 0);
    }
    function getData() {
      return other_details;
    }
    __expose({
      getData: getData
    });
    var __returned__ = {
      props: props,
      age_of_property: age_of_property,
      other_details: other_details,
      resetValue: resetValue,
      get isUpdatingMainUnit() {
        return isUpdatingMainUnit;
      },
      set isUpdatingMainUnit(v) {
        isUpdatingMainUnit = v;
      },
      setSameMainUnits: setSameMainUnits,
      getData: getData,
      reactive: vue__WEBPACK_IMPORTED_MODULE_0__.reactive,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_0__.onMounted
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=script&setup=true&lang=js":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=script&setup=true&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'flatForm',
  props: ['land_units', 'property_source', 'property_category', 'amenities'],
  setup: function setup(__props, _ref) {
    var __expose = _ref.expose;
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      $('#saleable_area_unit').select2().on('change', function () {
        other_details.saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#builtup_area_unit').select2().on('change', function () {
        other_details.builtup_area_unit = $(this).val();
      });
      $('#carpet_area_unit').select2().on('change', function () {
        other_details.carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#terrace_saleable_area_unit').select2().on('change', function () {
        other_details.terrace_saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#terrace_carpet_area_unit').select2().on('change', function () {
        other_details.terrace_carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
      });
      $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
      });
    });
    var props = __props;
    var age_of_property = ['0-1 Years', '1-5 Years', '5-10 Years', '10+ Years'];
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'saleable_area': '',
      'saleable_area_unit': '',
      'builtup_area': '',
      'builtup_area_unit': '',
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
      'number_of_bathrooms': '',
      'servent_room': '',
      'service_elevator': '',
      'is_hot': '',
      'four_wheeler_parking': '',
      'two_wheeler_parking': '',
      'priority': '',
      'source': '',
      'availability_status': '',
      'age_of_property': '',
      'available_from': '',
      'remark': '',
      'is_have_amenities': false,
      'amenities': props.amenities.reduce(function (acc, el) {
        return _objectSpread(_objectSpread({}, acc), {}, _defineProperty({}, el.id, false));
      }, {})
    });
    function getData() {
      return other_details;
    }
    function resetValue(array) {
      array.forEach(function (element) {
        other_details[element] = '';
      });
    }
    var isUpdatingMainUnit = false;
    function setSameMainUnits(value) {
      if (isUpdatingMainUnit) return;
      isUpdatingMainUnit = true;
      var input_array = ['saleable_area_unit', 'carpet_area_unit', 'terrace_saleable_area_unit', 'terrace_carpet_area_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingMainUnit = false;
      }, 0);
    }
    __expose({
      getData: getData
    });
    var __returned__ = {
      props: props,
      age_of_property: age_of_property,
      other_details: other_details,
      getData: getData,
      resetValue: resetValue,
      get isUpdatingMainUnit() {
        return isUpdatingMainUnit;
      },
      set isUpdatingMainUnit(v) {
        isUpdatingMainUnit = v;
      },
      setSameMainUnits: setSameMainUnits,
      reactive: vue__WEBPACK_IMPORTED_MODULE_0__.reactive,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_0__.onMounted
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=script&setup=true&lang=js":
/*!******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=script&setup=true&lang=js ***!
  \******************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'officeRetailForm',
  props: ['property_master', 'land_units', 'property_source', 'property_category'],
  setup: function setup(__props, _ref) {
    var _props$property_maste, _props$property_maste2, _props$property_maste3, _props$property_maste4, _props$property_maste5, _props$property_maste6, _props$property_maste7, _props$property_maste8, _props$property_maste9, _props$property_maste10, _ref2, _props$property_maste11, _ref3, _props$property_maste12, _props$property_maste13, _props$property_maste14, _props$property_maste15, _props$property_maste16, _props$property_maste17, _props$property_maste18, _props$property_maste19, _props$property_maste20, _props$property_maste21, _props$property_maste22;
    var __expose = _ref.expose;
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      $('#salable_area_unit').select2().on('change', function () {
        other_details.saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#ceiling_height_unit').select2().on('change', function () {
        other_details.ceiling_height_unit = $(this).val();
        setOtherUnits($(this).val());
      });
      $('#opening_width_unit').select2().on('change', function () {
        other_details.opening_width_unit = $(this).val();
        setOtherUnits($(this).val());
      });
      $('#carpet_area_unit').select2().on('change', function () {
        other_details.carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#terrace_saleable_area_unit').select2().on('change', function () {
        other_details.terrace_saleable_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#terrace_carpet_area_unit').select2().on('change', function () {
        other_details.terrace_carpet_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
      });
      $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
      });
      $('.select2-hidden-accessible').each(function () {
        var select2Instance = $(this).data('select2');
        if (select2Instance) {
          var options = $(this).children('option');
          select2Instance.trigger('select', {
            data: {
              id: options.eq(0).val(),
              text: options.eq(0).text()
            }
          });
        }
      });
      if (props.property_master.area_sizes.length == 1) {
        other_details.saleable_area = props.property_master.area_sizes[0].salable_area_value;
        // other_details.saleable_area_unit = props.property_master.area_sizes[0].salable_area_measurement_id
        $('#salable_area_unit').val(other_details.saleable_area_unit).trigger('change');
        other_details.opening_width = props.property_master.area_sizes[0].opening_width_value;
        $('#ceiling_height_unit').val(other_details.opening_width_unit).trigger('change');
        other_details.ceiling_height = props.property_master.area_sizes[0].ceiling_height_value;
        $('#opening_width_unit').val(other_details.ceiling_height_unit).trigger('change');
        other_details.add_carpet_area = props.property_master.area_sizes[0].carpet_area_value ? 1 : 0;
        other_details.carpet_area = props.property_master.area_sizes[0].carpet_area_value;
        $('#carpet_area_unit').val(other_details.carpet_area_unit).trigger('change');
        other_details.terrace_saleable_area = props.property_master.area_sizes[0].terrace_salable_area_value;
        $('#terrace_saleable_area_unit').val(other_details.terrace_saleable_area_unit).trigger('change');
        other_details.add_terrace_carpet_area = props.property_master.area_sizes[0].terrace_carpet_area_value ? 1 : 0;
        other_details.terrace_carpet_area = props.property_master.area_sizes[0].terrace_carpet_area_value;
        $('#terrace_carpet_area_unit').val(other_details.terrace_carpet_area_unit).trigger('change');
        other_details.is_terrace = props.property_master.area_sizes[0].terrace_salable_area_value || other_details.add_terrace_carpet_area ? 1 : 0;
      }
      if (props.property_master.washroom_type) {
        switch (props.property_master.washroom_type) {
          case 1:
            other_details.washrooms = 'Private Washrooms';
            break;
          case 2:
            other_details.washrooms = 'Public Washrooms';
            break;
          case 3:
            other_details.washrooms = 'Not Available';
            break;
          default:
            break;
        }
      }
      if (props.property_master.availability_status >= 0) {
        switch (props.property_master.availability_status) {
          case 0:
            other_details.availability_status = 'Under Construction';
            break;
          case 1:
            other_details.availability_status = 'Available';
            break;
          default:
            break;
        }
      }
      if (props.property_master.availability_status == 1) {
        switch (props.property_master.property_age) {
          case 1:
            other_details.age_of_property = '0-1 Years';
            break;
          case 2:
            other_details.age_of_property = '1-5 Years';
            break;
          case 3:
            other_details.age_of_property = '5-10 Years';
            break;
          case 4:
            other_details.age_of_property = '10+ Years';
            break;
          default:
            break;
        }
      } else {
        other_details.available_from = props.property_master.available_from;
      }
      if (props.property_master.priority_type) {
        switch (props.property_master.priority_type) {
          case 1:
            other_details.priority = 'High';
            $("#priority").val('High').trigger('change');
            break;
          case 2:
            $("#priority").val('Medium').trigger('change');
            break;
          case 3:
            $("#priority").val('Low').trigger('change');
            break;
          default:
            break;
        }
      }
      if (props.property_master.source) {
        other_details.source = props.property_master.source;
        $("#source").val(props.property_master.source).trigger('change');
      }
      console.log(props.property_master);
    });
    var props = __props;
    var age_of_property = ['0-1 Years', '1-5 Years', '5-10 Years', '10+ Years'];
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'saleable_area': '',
      'saleable_area_unit': '',
      'opening_width': '',
      'opening_width_unit': '',
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
      'units_in_project': (_props$property_maste = (_props$property_maste2 = props.property_master) === null || _props$property_maste2 === void 0 ? void 0 : _props$property_maste2.units_in_project) !== null && _props$property_maste !== void 0 ? _props$property_maste : '',
      'number_of_floor': (_props$property_maste3 = (_props$property_maste4 = props.property_master) === null || _props$property_maste4 === void 0 ? void 0 : _props$property_maste4.no_of_floors) !== null && _props$property_maste3 !== void 0 ? _props$property_maste3 : '',
      'units_in_towers': (_props$property_maste5 = (_props$property_maste6 = props.property_master) === null || _props$property_maste6 === void 0 ? void 0 : _props$property_maste6.units_in_tower) !== null && _props$property_maste5 !== void 0 ? _props$property_maste5 : '',
      'units_on_floor': (_props$property_maste7 = (_props$property_maste8 = props.property_master) === null || _props$property_maste8 === void 0 ? void 0 : _props$property_maste8.units_in_floor) !== null && _props$property_maste7 !== void 0 ? _props$property_maste7 : '',
      'number_of_elevators': (_props$property_maste9 = (_props$property_maste10 = props.property_master) === null || _props$property_maste10 === void 0 ? void 0 : _props$property_maste10.no_of_elevators) !== null && _props$property_maste9 !== void 0 ? _props$property_maste9 : '',
      'service_elevator': (_ref2 = ((_props$property_maste11 = props.property_master) === null || _props$property_maste11 === void 0 ? void 0 : _props$property_maste11.service_elevator) == 1) !== null && _ref2 !== void 0 ? _ref2 : false,
      'is_hot': (_ref3 = ((_props$property_maste12 = props.property_master) === null || _props$property_maste12 === void 0 ? void 0 : _props$property_maste12.hot_property) == 1) !== null && _ref3 !== void 0 ? _ref3 : false,
      'washrooms': '',
      'four_wheeler_parking': (_props$property_maste13 = (_props$property_maste14 = props.property_master) === null || _props$property_maste14 === void 0 ? void 0 : _props$property_maste14.fourwheller_parking) !== null && _props$property_maste13 !== void 0 ? _props$property_maste13 : '',
      'two_wheeler_parking': (_props$property_maste15 = (_props$property_maste16 = props.property_master) === null || _props$property_maste16 === void 0 ? void 0 : _props$property_maste16.twowheller_parking) !== null && _props$property_maste15 !== void 0 ? _props$property_maste15 : '',
      'priority': '',
      'source': '',
      'availability_status': '',
      'age_of_property': '',
      'available_from': (_props$property_maste17 = (_props$property_maste18 = props.property_master) === null || _props$property_maste18 === void 0 ? void 0 : _props$property_maste18.available_from) !== null && _props$property_maste17 !== void 0 ? _props$property_maste17 : '',
      'two_road_corner': (_props$property_maste19 = (_props$property_maste20 = props.property_master) === null || _props$property_maste20 === void 0 ? void 0 : _props$property_maste20.two_road_corner) !== null && _props$property_maste19 !== void 0 ? _props$property_maste19 : '',
      'remark': (_props$property_maste21 = (_props$property_maste22 = props.property_master) === null || _props$property_maste22 === void 0 ? void 0 : _props$property_maste22.remark) !== null && _props$property_maste21 !== void 0 ? _props$property_maste21 : ''
    });
    function resetValue(array) {
      array.forEach(function (element) {
        other_details[element] = '';
      });
    }
    var isUpdatingMainUnit = false;
    function setSameMainUnits(value) {
      if (isUpdatingMainUnit) return;
      isUpdatingMainUnit = true;
      var input_array = ['salable_area_unit', 'carpet_area_unit', 'terrace_carpet_area_unit', 'terrace_saleable_area_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingMainUnit = false;
      }, 0);
    }
    var isUpdatingOtherUnit = false;
    function setOtherUnits(value) {
      if (isUpdatingOtherUnit) return;
      isUpdatingOtherUnit = true;
      var input_array = ['ceiling_height_unit', 'opening_width_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingOtherUnit = false;
      }, 0);
    }
    function getData() {
      return other_details;
    }
    __expose({
      getData: getData
    });
    var __returned__ = {
      props: props,
      age_of_property: age_of_property,
      other_details: other_details,
      resetValue: resetValue,
      get isUpdatingMainUnit() {
        return isUpdatingMainUnit;
      },
      set isUpdatingMainUnit(v) {
        isUpdatingMainUnit = v;
      },
      setSameMainUnits: setSameMainUnits,
      get isUpdatingOtherUnit() {
        return isUpdatingOtherUnit;
      },
      set isUpdatingOtherUnit(v) {
        isUpdatingOtherUnit = v;
      },
      setOtherUnits: setOtherUnits,
      getData: getData,
      reactive: vue__WEBPACK_IMPORTED_MODULE_0__.reactive,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_0__.onMounted
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=script&setup=true&lang=js":
/*!***********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=script&setup=true&lang=js ***!
  \***********************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'storageIndustrialForm',
  props: ['land_units', 'property_source', 'property_category'],
  setup: function setup(__props, _ref) {
    var __expose = _ref.expose;
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(function () {
      $('#saleable_plot_area_unit').select2().on('change', function () {
        other_details.saleable_plot_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#carpet_plot_area_unit').select2().on('change', function () {
        other_details.carpet_plot_area_unit = $(this).val();
        setSameMainUnits($(this).val());
      });
      $('#road_width_of_front_side_unit').select2().on('change', function () {
        other_details.road_width_of_front_side_unit = $(this).val();
      });
      $('#priority').select2().on('change', function () {
        other_details.priority = $(this).val();
      });
      $('#source').select2().on('change', function () {
        other_details.source = $(this).val();
      });
      $('.select2-hidden-accessible').each(function () {
        var select2Instance = $(this).data('select2');
        if (select2Instance) {
          var options = $(this).children('option');
          select2Instance.trigger('select', {
            data: {
              id: options.eq(0).val(),
              text: options.eq(0).text()
            }
          });
        }
      });
    });
    var props = __props;
    var age_of_property = ['0-1 Years', '1-5 Years', '5-10 Years', '10+ Years'];
    var other_details = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
      'saleable_plot_area': '',
      'saleable_plot_area_unit': '',
      'add_carpet_plot_area': '',
      'carpet_plot_area': '',
      'carpet_plot_area_unit': '',
      'road_width_of_front_side': '',
      'road_width_of_front_side_unit': '',
      'units_in_project': '',
      'is_hot': '',
      'four_wheeler_parking': '',
      'two_wheeler_parking': '',
      'priority': '',
      'source': '',
      'availability_status': '',
      'age_of_property': '',
      'available_from': '',
      'two_road_corner': '',
      'remark': '',
      'temp_input_field': '',
      'other_storage_industrial_detail': [{
        'name': 'Pollution Control Board',
        'value': '',
        'is_active': '',
        'exist': true
      }, {
        'name': 'EC/NOC',
        'value': '',
        'is_active': '',
        'exist': true
      }, {
        'name': 'Gas',
        'value': '',
        'is_active': '',
        'exist': true
      }, {
        'name': 'Power',
        'value': '',
        'is_active': '',
        'exist': true
      }, {
        'name': 'Water',
        'value': '',
        'is_active': '',
        'exist': true
      }]
    });
    function addOtherField() {
      other_details.other_storage_industrial_detail.push({
        'name': other_details.temp_input_field,
        'value': '',
        'is_active': '',
        'exist': false
      });
      other_details.temp_input_field = '';
    }
    function removeOtherDetail(index) {
      other_details.other_storage_industrial_detail.splice(index, 1);
    }
    function resetValue(array) {
      array.forEach(function (element) {
        other_details[element] = '';
      });
    }
    var isUpdatingMainUnit = false;
    function setSameMainUnits(value) {
      if (isUpdatingMainUnit) return;
      isUpdatingMainUnit = true;
      var input_array = ['saleable_plot_area_unit', 'carpet_plot_area_unit'];
      input_array.forEach(function (select_input) {
        $("#".concat(select_input)).val(value).trigger('change');
      });
      setTimeout(function () {
        isUpdatingMainUnit = false;
      }, 0);
    }
    function getData() {
      return other_details;
    }
    __expose({
      getData: getData
    });
    var __returned__ = {
      props: props,
      age_of_property: age_of_property,
      other_details: other_details,
      addOtherField: addOtherField,
      removeOtherDetail: removeOtherDetail,
      resetValue: resetValue,
      get isUpdatingMainUnit() {
        return isUpdatingMainUnit;
      },
      set isUpdatingMainUnit(v) {
        isUpdatingMainUnit = v;
      },
      setSameMainUnits: setSameMainUnits,
      getData: getData,
      reactive: vue__WEBPACK_IMPORTED_MODULE_0__.reactive,
      onMounted: vue__WEBPACK_IMPORTED_MODULE_0__.onMounted
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/EditForm.vue?vue&type=template&id=0c36e366":
/*!***************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/EditForm.vue?vue&type=template&id=0c36e366 ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************/
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
  "class": "row mt-5"
};
var _hoisted_23 = {
  "class": "col-md-3 m-b-4 mb-4"
};
var _hoisted_24 = {
  "class": "form-select",
  id: "project_id"
};
var _hoisted_25 = ["value"];
var _hoisted_26 = {
  "class": "col-md-3 m-b-4 mb-4"
};
var _hoisted_27 = {
  "class": "form-select",
  id: "city_id"
};
var _hoisted_28 = ["value", "selected"];
var _hoisted_29 = {
  "class": "col-md-3 m-b-4 mb-4"
};
var _hoisted_30 = {
  "class": "form-select",
  id: "locality_id"
};
var _hoisted_31 = ["value"];
var _hoisted_32 = {
  "class": "row mt-5"
};
var _hoisted_33 = {
  "class": "col-md-3 m-b-4 mb-4"
};
var _hoisted_34 = {
  "class": "form-select",
  id: "district_id"
};
var _hoisted_35 = ["value"];
var _hoisted_36 = {
  "class": "col-md-3 m-b-4 mb-4"
};
var _hoisted_37 = {
  "class": "form-select",
  id: "taluka_id"
};
var _hoisted_38 = ["value"];
var _hoisted_39 = {
  "class": "col-md-3 m-b-4 mb-4"
};
var _hoisted_40 = {
  "class": "form-select",
  id: "village_id"
};
var _hoisted_41 = ["value"];
var _hoisted_42 = {
  "class": "row mt-2"
};
var _hoisted_43 = {
  "class": "col-md-3 m-b-4 mb-4"
};
var _hoisted_44 = {
  "class": "form-select",
  id: "zone_id"
};
var _hoisted_45 = ["value"];
var _hoisted_46 = {
  "class": "row"
};
var _hoisted_47 = {
  "class": "col-md-5 m-b-4 mb-3"
};
var _hoisted_48 = {
  "class": "fvalue"
};
var _hoisted_49 = {
  "class": "col-md-5 m-b-4 mb-3"
};
var _hoisted_50 = {
  "class": "fvalue"
};
var _hoisted_51 = {
  "class": "row mt-5"
};
var _hoisted_52 = {
  "class": "row mt-2"
};
var _hoisted_53 = {
  "class": "col-12 col-md-2"
};
var _hoisted_54 = ["for"];
var _hoisted_55 = {
  "class": "fvalue"
};
var _hoisted_56 = ["id", "onUpdate:modelValue"];
var _hoisted_57 = {
  "class": "col-12 col-md-2"
};
var _hoisted_58 = ["for"];
var _hoisted_59 = {
  "class": "fvalue"
};
var _hoisted_60 = ["id", "onUpdate:modelValue"];
var _hoisted_61 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_62 = ["id"];
var _hoisted_63 = {
  key: 0,
  "class": "col-12 col-md-2"
};
var _hoisted_64 = ["for"];
var _hoisted_65 = {
  "class": "fvalue"
};
var _hoisted_66 = ["id", "onUpdate:modelValue"];
var _hoisted_67 = {
  key: 1,
  "class": "col-12 col-md-2"
};
var _hoisted_68 = ["for"];
var _hoisted_69 = {
  "class": "fvalue"
};
var _hoisted_70 = ["id", "onUpdate:modelValue"];
var _hoisted_71 = {
  key: 2,
  "class": "col-12 col-md-2"
};
var _hoisted_72 = ["for"];
var _hoisted_73 = {
  "class": "fvalue"
};
var _hoisted_74 = ["id", "onUpdate:modelValue"];
var _hoisted_75 = {
  key: 3,
  "class": "col-12 col-md-2"
};
var _hoisted_76 = ["for"];
var _hoisted_77 = {
  "class": "fvalue"
};
var _hoisted_78 = ["id", "onUpdate:modelValue"];
var _hoisted_79 = {
  key: 4,
  "class": "col-12 col-md-2"
};
var _hoisted_80 = ["for"];
var _hoisted_81 = {
  "class": "fvalue"
};
var _hoisted_82 = ["id", "onUpdate:modelValue"];
var _hoisted_83 = {
  key: 5,
  "class": "col-12 col-md-2"
};
var _hoisted_84 = ["for"];
var _hoisted_85 = {
  "class": "fvalue"
};
var _hoisted_86 = ["id", "onUpdate:modelValue"];
var _hoisted_87 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_88 = ["id"];
var _hoisted_89 = {
  key: 6,
  "class": "col-md-1 m-b-4 mb-4"
};
var _hoisted_90 = {
  key: 7,
  "class": "col-md-1 m-b-4 mb-4"
};
var _hoisted_91 = ["onClick"];
var _hoisted_92 = {
  key: 0,
  "class": "row mt-2"
};
var _hoisted_93 = {
  "class": "col-12 col-md-2"
};
var _hoisted_94 = ["for"];
var _hoisted_95 = {
  "class": "fvalue"
};
var _hoisted_96 = ["id", "onUpdate:modelValue"];
var _hoisted_97 = {
  "class": "col-12 col-md-2"
};
var _hoisted_98 = ["for"];
var _hoisted_99 = {
  "class": "fvalue"
};
var _hoisted_100 = ["id", "onUpdate:modelValue"];
var _hoisted_101 = {
  "class": "col-12 col-md-2"
};
var _hoisted_102 = ["for"];
var _hoisted_103 = {
  "class": "fvalue"
};
var _hoisted_104 = ["id", "onUpdate:modelValue"];
var _hoisted_105 = {
  "class": "col-12 col-md-6"
};
var _hoisted_106 = {
  "class": "row div_checkboxes1 gy-3"
};
var _hoisted_107 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_108 = ["id", "onUpdate:modelValue"];
var _hoisted_109 = ["for"];
var _hoisted_110 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_111 = ["id", "onUpdate:modelValue"];
var _hoisted_112 = ["for"];
var _hoisted_113 = {
  key: 1,
  "class": "row mt-2"
};
var _hoisted_114 = {
  "class": "col-12 col-md-4"
};
var _hoisted_115 = ["for"];
var _hoisted_116 = {
  "class": "fvalue"
};
var _hoisted_117 = ["id", "onUpdate:modelValue"];
var _hoisted_118 = {
  "class": "row gy-2"
};
var _hoisted_119 = {
  "class": "col-12 col-md-4 col-lg-4"
};
var _hoisted_120 = {
  "class": "mb-3 d-flex align-items-center"
};
var _hoisted_121 = ["onClick", "disabled"];
var _hoisted_122 = ["id", "onUpdate:modelValue"];
var _hoisted_123 = ["onClick"];
var _hoisted_124 = {
  "class": "mb-3 d-flex align-items-center"
};
var _hoisted_125 = ["onClick", "disabled"];
var _hoisted_126 = ["id", "onUpdate:modelValue"];
var _hoisted_127 = ["onClick"];
var _hoisted_128 = {
  "class": "mb-3 d-flex align-items-center"
};
var _hoisted_129 = ["onClick", "disabled"];
var _hoisted_130 = ["id", "onUpdate:modelValue"];
var _hoisted_131 = ["onClick"];
var _hoisted_132 = {
  "class": "mb-3 d-flex align-items-center"
};
var _hoisted_133 = ["onClick", "disabled"];
var _hoisted_134 = ["id", "onUpdate:modelValue"];
var _hoisted_135 = ["onClick"];
var _hoisted_136 = {
  "class": "col-12 col-md-4 col-lg-4"
};
var _hoisted_137 = {
  "class": "mb-3 d-flex align-items-center"
};
var _hoisted_138 = ["onClick", "disabled"];
var _hoisted_139 = ["id", "onUpdate:modelValue"];
var _hoisted_140 = ["onClick"];
var _hoisted_141 = {
  "class": "mb-3 d-flex align-items-center"
};
var _hoisted_142 = ["onClick", "disabled"];
var _hoisted_143 = ["id", "onUpdate:modelValue"];
var _hoisted_144 = ["onClick"];
var _hoisted_145 = {
  "class": "mb-3 d-flex align-items-center"
};
var _hoisted_146 = ["onClick", "disabled"];
var _hoisted_147 = ["id", "onUpdate:modelValue"];
var _hoisted_148 = ["onClick"];
var _hoisted_149 = {
  "class": "mb-3 d-flex align-items-center"
};
var _hoisted_150 = ["onClick", "disabled"];
var _hoisted_151 = ["id", "onUpdate:modelValue"];
var _hoisted_152 = ["onClick"];
var _hoisted_153 = {
  "class": "row gy-2"
};
var _hoisted_154 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_155 = ["id", "onUpdate:modelValue"];
var _hoisted_156 = ["for"];
var _hoisted_157 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_158 = ["id", "onUpdate:modelValue"];
var _hoisted_159 = ["for"];
var _hoisted_160 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_161 = ["id", "onUpdate:modelValue"];
var _hoisted_162 = ["for"];
var _hoisted_163 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_164 = ["id", "onUpdate:modelValue"];
var _hoisted_165 = ["for"];
var _hoisted_166 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_167 = ["id", "onUpdate:modelValue"];
var _hoisted_168 = ["for"];
var _hoisted_169 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_170 = ["id", "onUpdate:modelValue"];
var _hoisted_171 = ["for"];
var _hoisted_172 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_173 = ["id", "onUpdate:modelValue"];
var _hoisted_174 = ["for"];
var _hoisted_175 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_176 = ["id", "onUpdate:modelValue"];
var _hoisted_177 = ["for"];
var _hoisted_178 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_179 = ["id", "onUpdate:modelValue"];
var _hoisted_180 = ["for"];
var _hoisted_181 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_182 = ["id", "onUpdate:modelValue"];
var _hoisted_183 = ["for"];
var _hoisted_184 = {
  "class": "row mt-3"
};
var _hoisted_185 = {
  "class": "row gy-2 mt-2"
};
var _hoisted_186 = {
  "class": "col-12 col-md-3"
};
var _hoisted_187 = {
  "class": "fvalue"
};
var _hoisted_188 = {
  "class": "col-md-4"
};
var _hoisted_189 = {
  "class": "input-group"
};
var _hoisted_190 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_191 = {
  "class": "fvalue"
};
var _hoisted_192 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_193 = {
  "class": "form-group"
};
var _hoisted_194 = {
  "class": "form-select",
  id: "survey_plot_size_unit"
};
var _hoisted_195 = ["value"];
var _hoisted_196 = {
  "class": "col-12 col-md-3"
};
var _hoisted_197 = {
  "class": "fvalue"
};
var _hoisted_198 = {
  "class": "row mt-2"
};
var _hoisted_199 = {
  "class": "row gy-2 mt-2"
};
var _hoisted_200 = {
  "class": "col-12 col-md-3"
};
var _hoisted_201 = {
  "class": "fvalue"
};
var _hoisted_202 = {
  "class": "col-12 col-md-3"
};
var _hoisted_203 = {
  "class": "fvalue"
};
var _hoisted_204 = {
  "class": "col-12 col-md-3"
};
var _hoisted_205 = {
  "class": "input-group"
};
var _hoisted_206 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_207 = {
  "class": "fvalue"
};
var _hoisted_208 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_209 = {
  "class": "form-group"
};
var _hoisted_210 = {
  "class": "form-select",
  id: "tp_plot_size_unit"
};
var _hoisted_211 = ["value"];
var _hoisted_212 = {
  "class": "col-12 col-md-3"
};
var _hoisted_213 = {
  "class": "fvalue"
};
var _hoisted_214 = {
  "class": "row gy-2 mt-2"
};
var _hoisted_215 = {
  "class": "col-12 col-md-2"
};
var _hoisted_216 = {
  "class": "fvalue"
};
var _hoisted_217 = {
  "class": "col-12 col-md-3"
};
var _hoisted_218 = {
  "class": "input-group"
};
var _hoisted_219 = {
  "class": "input-group-append col-md-4 m-b-20"
};
var _hoisted_220 = {
  "class": "form-group country_code"
};
var _hoisted_221 = {
  "class": "form-select country_co",
  id: "owner_contact_code"
};
var _hoisted_222 = ["value"];
var _hoisted_223 = {
  "class": "form-group col-md-8"
};
var _hoisted_224 = {
  "class": "fvalue"
};
var _hoisted_225 = {
  "class": "col-12 col-md-3"
};
var _hoisted_226 = {
  "class": "fvalue"
};
var _hoisted_227 = {
  "class": "row mt-2"
};
var _hoisted_228 = {
  "class": "col-12 col-md-2"
};
var _hoisted_229 = ["for"];
var _hoisted_230 = {
  "class": "fvalue"
};
var _hoisted_231 = ["id", "onUpdate:modelValue"];
var _hoisted_232 = {
  "class": "col-12 col-md-3"
};
var _hoisted_233 = {
  "class": "input-group"
};
var _hoisted_234 = {
  "class": "input-group-append col-md-4 m-b-20"
};
var _hoisted_235 = {
  "class": "form-group country_code"
};
var _hoisted_236 = ["id"];
var _hoisted_237 = ["value"];
var _hoisted_238 = {
  "class": "form-group col-md-8"
};
var _hoisted_239 = ["for"];
var _hoisted_240 = {
  "class": "fvalue"
};
var _hoisted_241 = ["id", "onUpdate:modelValue"];
var _hoisted_242 = {
  "class": "col-12 col-md-2"
};
var _hoisted_243 = ["for"];
var _hoisted_244 = {
  "class": "fvalue"
};
var _hoisted_245 = ["id", "onUpdate:modelValue"];
var _hoisted_246 = {
  key: 0,
  "class": "col-md-1 m-b-4 mb-4"
};
var _hoisted_247 = {
  key: 1,
  "class": "col-md-1 m-b-4 mb-4"
};
var _hoisted_248 = ["onClick"];
var _hoisted_249 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_250 = {
  "class": "col-12 col-md-4"
};
var _hoisted_251 = {
  "class": "col-12 col-md-4"
};
var _hoisted_252 = {
  "class": "row mt-4"
};
var _hoisted_253 = {
  "class": "col-12 col-3"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [_cache[68] || (_cache[68] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-12 col-md-3 col-lg-2\"><div class=\"bromi-form-wizard stepwizard\"><div class=\"stepwizard-row setup-panel\"><div class=\"stepwizard-step mb-5\"><button class=\"btn btn-primary\" id=\"step0\" data-action=\"#information-step\">1</button><p class=\"ms-2\">Information</p></div><div class=\"stepwizard-step mb-5\"><button class=\"btn btn-light\" id=\"step1\" data-action=\"#profile-step\">2</button><p class=\"ms-2\">Property Details</p></div><div class=\"stepwizard-step\"><button class=\"btn btn-light\" id=\"step2\" data-action=\"#unit-owner-step\">3</button><p class=\"ms-2\">Unit &amp; Contact Information</p></div></div></div></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_cache[28] || (_cache[28] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
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
      })
    }, null, 8 /* PROPS */, _hoisted_6), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_for]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "btn btn-outline-info btn-pill btn-sm py-1",
      "for": "property_for_".concat(index)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(propery_for.name), 9 /* TEXT, PROPS */, _hoisted_7)]);
  }), 128 /* KEYED_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [_cache[25] || (_cache[25] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Property Construction Type")], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_construction_type, function (construction_type, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: "property_construction_type_".concat(index)
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: construction_type.name,
      type: "radio",
      name: "property_type",
      value: construction_type.id,
      "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
        return $setup.data.property_construction_type = $event;
      }),
      onChange: _cache[2] || (_cache[2] = function ($event) {
        return $setup.resetValue(2);
      }),
      disabled: ""
    }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_10), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_construction_type]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label ms-2",
      "for": construction_type.name
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(construction_type.name), 9 /* TEXT, PROPS */, _hoisted_11)], 64 /* STABLE_FRAGMENT */);
  }), 128 /* KEYED_FRAGMENT */))])]), $setup.data.property_construction_type ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
    key: 0
  }, [_cache[26] || (_cache[26] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Category")], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_construction_type, function (construction_type, index) {
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
        "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
          return $setup.data.property_category = $event;
        }),
        onChange: _cache[4] || (_cache[4] = function ($event) {
          return $setup.resetValue(3);
        }),
        disabled: ""
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
        "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
          return $setup.data.property_category = $event;
        }),
        onChange: _cache[6] || (_cache[6] = function ($event) {
          return $setup.resetValue(3);
        }),
        disabled: ""
      }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_17), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_category]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
        "class": "btn btn-outline-primary btn-pill btn-sm py-1",
        "for": "category-".concat(category.id, "}")
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(category.name), 9 /* TEXT, PROPS */, _hoisted_18)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */))], 64 /* STABLE_FRAGMENT */);
    }), 128 /* KEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 128 /* KEYED_FRAGMENT */))])], 64 /* STABLE_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $setup.data.property_category && $setup.data.property_category != 8 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
    key: 1
  }, [_cache[27] || (_cache[27] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Sub Category")], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_construction_type, function (construction_type, type_index) {
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
          "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
            return $setup.data.property_sub_category = $event;
          }),
          disabled: ""
        }, null, 8 /* PROPS */, _hoisted_20), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.data.property_sub_category]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
          "class": "btn btn-outline-primary btn-pill btn-sm py-1",
          "for": "sub-category-".concat(sub_cat.id, "}")
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(sub_cat.name), 9 /* TEXT, PROPS */, _hoisted_21)]);
      }), 128 /* KEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
    }), 128 /* KEYED_FRAGMENT */))], 64 /* STABLE_FRAGMENT */);
  }), 128 /* KEYED_FRAGMENT */))])], 64 /* STABLE_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_24, [_cache[29] || (_cache[29] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Project", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.projects, function (project) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: project.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(project.project_name), 9 /* TEXT, PROPS */, _hoisted_25);
  }), 256 /* UNKEYED_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_27, [_cache[30] || (_cache[30] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "City", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.cities, function (city, city_index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: city.id,
      selected: city_index == 0
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(city.name), 9 /* TEXT, PROPS */, _hoisted_28);
  }), 256 /* UNKEYED_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_30, [_cache[31] || (_cache[31] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Locality", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.cities, function (city) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [city.id == $setup.data.selected_city ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(city.localities, function (locality) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
        value: locality.id
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(locality.name), 9 /* TEXT, PROPS */, _hoisted_31);
    }), 256 /* UNKEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.data.property_category !== 4]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_34, [_cache[32] || (_cache[32] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "District", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.districts, function (district) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: district.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(district.name), 9 /* TEXT, PROPS */, _hoisted_35);
  }), 256 /* UNKEYED_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_37, [_cache[33] || (_cache[33] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Taluka", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.districts, function (district) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [district.id == $setup.data.selected_district ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(district.talukas, function (taluka) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
        value: taluka.id
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(taluka.name), 9 /* TEXT, PROPS */, _hoisted_38);
    }), 256 /* UNKEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_40, [_cache[34] || (_cache[34] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Village", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.districts, function (district) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [district.id == $setup.data.selected_district ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(district.talukas, function (taluka) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [taluka.id == $setup.data.selected_taluka ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
        key: 0
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(taluka.villages, function (village) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
          value: village.id
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(village.name), 9 /* TEXT, PROPS */, _hoisted_41);
      }), 256 /* UNKEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
    }), 256 /* UNKEYED_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.data.property_category == 4]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_44, [_cache[35] || (_cache[35] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Zones", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_zones, function (zone) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: zone.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(zone.name), 9 /* TEXT, PROPS */, _hoisted_45);
  }), 256 /* UNKEYED_FRAGMENT */))])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.data.property_category == 4 || $setup.data.property_category == 8]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_47, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.data.address !== '' ? 'focused' : ''])
  }, [_cache[36] || (_cache[36] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "address"
  }, "Address", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "address",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $setup.data.address = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.data.address]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.data.location_link !== '' ? 'focused' : ''])
  }, [_cache[37] || (_cache[37] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "location_link"
  }, "Location Link", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    id: "location_link",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.data.location_link = $event;
    }),
    style: {
      "text-transform": "lowercase !important"
    }
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.data.location_link]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" first part end "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" second part start "), [1, 2].includes($setup.data.property_category) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["officeRetailForm"], {
    key: 0,
    ref: "office_retail_form",
    property_master: $props.property_master,
    land_units: $setup.props.land_units,
    property_source: $setup.props.property_source,
    property_category: $setup.data.property_category
  }, null, 8 /* PROPS */, ["property_master", "land_units", "property_source", "property_category"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [3].includes($setup.data.property_category) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["storageIndustrialForm"], {
    key: 1,
    ref: "storage_industrial_form",
    land_units: $setup.props.land_units,
    property_source: $setup.props.property_source,
    property_category: $setup.data.property_category
  }, null, 8 /* PROPS */, ["land_units", "property_source", "property_category"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [4].includes($setup.data.property_category) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["landForm"], {
    key: 2,
    ref: "land_form",
    land_units: $setup.props.land_units,
    property_source: $setup.props.property_source,
    property_category: $setup.data.property_category
  }, null, 8 /* PROPS */, ["land_units", "property_source", "property_category"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [5].includes($setup.data.property_category) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["flatForm"], {
    key: 3,
    ref: "flat_form",
    land_units: $setup.props.land_units,
    property_source: $setup.props.property_source,
    property_category: $setup.data.property_category,
    amenities: $setup.props.amenities
  }, null, 8 /* PROPS */, ["land_units", "property_source", "property_category", "amenities"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [6].includes($setup.data.property_category) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["vilaBanglowForm"], {
    key: 4,
    ref: "villa_banglow_form",
    land_units: $setup.props.land_units,
    property_source: $setup.props.property_source,
    property_category: $setup.data.property_category,
    amenities: $setup.props.amenities
  }, null, 8 /* PROPS */, ["land_units", "property_source", "property_category", "amenities"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [7].includes($setup.data.property_category) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["penthouseForm"], {
    key: 5,
    ref: "penthouse_form",
    land_units: $setup.props.land_units,
    property_source: $setup.props.property_source,
    property_category: $setup.data.property_category,
    amenities: $setup.props.amenities
  }, null, 8 /* PROPS */, ["land_units", "property_source", "property_category", "amenities"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [8].includes($setup.data.property_category) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)($setup["PlotForm"], {
    key: 6,
    ref: "plot_form",
    land_units: $setup.props.land_units,
    property_source: $setup.props.property_source,
    property_category: $setup.data.property_category,
    amenities: $setup.props.amenities
  }, null, 8 /* PROPS */, ["land_units", "property_source", "property_category", "amenities"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" second part end "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" 3rd part start "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_51, [_cache[48] || (_cache[48] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Unit Details", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.unit_details, function (unit, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.wing !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_wing_".concat(index)
    }, "Wing", 8 /* PROPS */, _hoisted_54), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_55, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_wing_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.wing = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_56), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.wing]])])], 2 /* CLASS */)], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, ![6, 8].includes($setup.data.property_category)]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.unit_number !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_unit_number_".concat(index)
    }, "Unit No", 8 /* PROPS */, _hoisted_58), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_unit_number_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.unit_number = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_60), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.unit_number]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "class": "form-select",
      id: "unit_available_".concat(index)
    }, _toConsumableArray(_cache[38] || (_cache[38] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
      value: ""
    }, "Available", -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
      value: "Rent Out"
    }, "Rent Out", -1 /* HOISTED */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
      value: "Sold Out"
    }, "Sold Out", -1 /* HOISTED */)])), 8 /* PROPS */, _hoisted_62)]), [1, 3].includes($setup.data.property_for) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_63, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.price_rent !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_price_rent_".concat(index)
    }, "Price Rent", 8 /* PROPS */, _hoisted_64), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_price_rent_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.price_rent = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_66), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.price_rent]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [2, 3].includes($setup.data.property_for) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.price !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_price_".concat(index)
    }, "Price", 8 /* PROPS */, _hoisted_68), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_price_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.price = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_70), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.price]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [2, 3].includes($setup.data.property_for) && $setup.data.property_category == 7 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.terrace_price !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_terrace_price_".concat(index)
    }, "Terrace Price", 8 /* PROPS */, _hoisted_72), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_terrace_price_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.terrace_price = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_74), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.terrace_price]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [2, 3].includes($setup.data.property_for) && $setup.data.property_category == 7 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_75, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.flat_price !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_flat_price_".concat(index)
    }, "Flat Price", 8 /* PROPS */, _hoisted_76), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_77, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_flat_price_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.flat_price = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_78), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.flat_price]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [2, 3].includes($setup.data.property_for) && $setup.data.property_category == 6 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_79, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.plot_price !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_plot_price_".concat(index)
    }, "Plot Price", 8 /* PROPS */, _hoisted_80), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_81, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_plot_price_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.plot_price = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_82), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.plot_price]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [2, 3].includes($setup.data.property_for) && $setup.data.property_category == 6 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_83, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.construction_price !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_construction_price_".concat(index)
    }, "Construction Price", 8 /* PROPS */, _hoisted_84), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_85, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_construction_price_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.construction_price = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_86), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.construction_price]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_87, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "class": "form-select",
      id: "furnished_status_".concat(index)
    }, _toConsumableArray(_cache[39] || (_cache[39] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<option value=\"\">Furnished Status</option><option value=\"1\">Furnished</option><option value=\"2\">Semi Furnished</option><option value=\"3\">Unfurnished</option><option value=\"4\">Can Furnished</option>", 5)])), 8 /* PROPS */, _hoisted_88)], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, ![3, 8].includes($setup.data.property_category)]]), index == 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_89, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      type: "button",
      onClick: _cache[10] || (_cache[10] = function ($event) {
        return $setup.addUnit();
      })
    }, "+")])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_90, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-danger",
      type: "button",
      onClick: function onClick($event) {
        return $setup.removeUnit(index);
      }
    }, "-", 8 /* PROPS */, _hoisted_91)]))]), [1, 2, 4].includes(parseInt(unit.furnished_status)) && $setup.data.property_category == 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_92, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_93, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.no_of_seats !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_no_of_seats_".concat(index)
    }, "No. of seats", 8 /* PROPS */, _hoisted_94), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_no_of_seats_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.no_of_seats = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_96), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.no_of_seats]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_97, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.no_of_cabins !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_no_of_cabins_".concat(index)
    }, "No. of cabins", 8 /* PROPS */, _hoisted_98), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_99, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_no_of_cabins_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.no_of_cabins = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_100), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.no_of_cabins]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_101, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.no_of_conference_room !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_no_of_conference_room_".concat(index)
    }, "No. of conference room", 8 /* PROPS */, _hoisted_102), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_103, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_no_of_conference_room_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.no_of_conference_room = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_104), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.no_of_conference_room]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_105, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_106, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_107, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "pantry_".concat(index),
      value: "pantry",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_108), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "pantry_".concat(index)
    }, "Pantry", 8 /* PROPS */, _hoisted_109)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_110, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "reception_".concat(index),
      value: "reception",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_111), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "reception_".concat(index)
    }, "Reception", 8 /* PROPS */, _hoisted_112)])])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [1, 2, 4].includes(parseInt(unit.furnished_status)) && $setup.data.property_category == 2 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_113, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_114, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", unit.remark !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "unit_remark_".concat(index)
    }, "Remarks", 8 /* PROPS */, _hoisted_115), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_116, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "unit_remark_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.remark = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_117), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.remark]])])], 2 /* CLASS */)])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), [1, 2, 4].includes(parseInt(unit.furnished_status)) && [5, 6, 7].includes(parseInt($setup.data.property_category)) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 2
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_118, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_119, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_120, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      onClick: function onClick($event) {
        return unit.furniture_total.light > 0 ? unit.furniture_total.light-- : '';
      },
      disabled: unit.furniture_total.light == 0
    }, "−", 8 /* PROPS */, _hoisted_121), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "text",
      id: "light_".concat(index),
      "class": "form-control text-center border-0",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.furniture_total.light = $event;
      },
      value: "0",
      style: {
        "max-width": "80px"
      },
      readonly: ""
    }, null, 8 /* PROPS */, _hoisted_122), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.furniture_total.light]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary me-2",
      onClick: function onClick($event) {
        return unit.furniture_total.light++;
      }
    }, "+", 8 /* PROPS */, _hoisted_123), _cache[40] || (_cache[40] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Light "))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_124, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      onClick: function onClick($event) {
        return unit.furniture_total.ac > 0 ? unit.furniture_total.ac-- : '';
      },
      disabled: unit.furniture_total.ac == 0
    }, "−", 8 /* PROPS */, _hoisted_125), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "text",
      id: "ac_".concat(index),
      "class": "form-control text-center border-0",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.furniture_total.ac = $event;
      },
      value: "0",
      style: {
        "max-width": "80px"
      },
      readonly: ""
    }, null, 8 /* PROPS */, _hoisted_126), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.furniture_total.ac]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary me-2",
      onClick: function onClick($event) {
        return unit.furniture_total.ac++;
      }
    }, "+", 8 /* PROPS */, _hoisted_127), _cache[41] || (_cache[41] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" AC "))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_128, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      onClick: function onClick($event) {
        return unit.furniture_total.beds > 0 ? unit.furniture_total.beds-- : '';
      },
      disabled: unit.furniture_total.beds == 0
    }, "−", 8 /* PROPS */, _hoisted_129), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "text",
      id: "beds_".concat(index),
      "class": "form-control text-center border-0",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.furniture_total.beds = $event;
      },
      value: "0",
      style: {
        "max-width": "80px"
      },
      readonly: ""
    }, null, 8 /* PROPS */, _hoisted_130), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.furniture_total.beds]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary me-2",
      onClick: function onClick($event) {
        return unit.furniture_total.beds++;
      }
    }, "+", 8 /* PROPS */, _hoisted_131), _cache[42] || (_cache[42] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Beds "))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_132, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      onClick: function onClick($event) {
        return unit.furniture_total.geyser > 0 ? unit.furniture_total.geyser-- : '';
      },
      disabled: unit.furniture_total.geyser == 0
    }, "−", 8 /* PROPS */, _hoisted_133), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "text",
      id: "geyser_".concat(index),
      "class": "form-control text-center border-0",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.furniture_total.geyser = $event;
      },
      value: "0",
      style: {
        "max-width": "80px"
      },
      readonly: ""
    }, null, 8 /* PROPS */, _hoisted_134), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.furniture_total.geyser]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary me-2",
      onClick: function onClick($event) {
        return unit.furniture_total.geyser++;
      }
    }, "+", 8 /* PROPS */, _hoisted_135), _cache[43] || (_cache[43] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Geyser "))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_136, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_137, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      onClick: function onClick($event) {
        return unit.furniture_total.fans > 0 ? unit.furniture_total.fans-- : '';
      },
      disabled: unit.furniture_total.fans == 0
    }, "−", 8 /* PROPS */, _hoisted_138), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "text",
      id: "fans_".concat(index),
      "class": "form-control text-center border-0",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.furniture_total.fans = $event;
      },
      value: "0",
      style: {
        "max-width": "80px"
      },
      readonly: ""
    }, null, 8 /* PROPS */, _hoisted_139), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.furniture_total.fans]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary me-2",
      onClick: function onClick($event) {
        return unit.furniture_total.fans++;
      }
    }, "+", 8 /* PROPS */, _hoisted_140), _cache[44] || (_cache[44] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Fans "))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_141, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      onClick: function onClick($event) {
        return unit.furniture_total.tv > 0 ? unit.furniture_total.tv-- : '';
      },
      disabled: unit.furniture_total.tv == 0
    }, "−", 8 /* PROPS */, _hoisted_142), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "text",
      id: "tv_".concat(index),
      "class": "form-control text-center border-0",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.furniture_total.tv = $event;
      },
      value: "0",
      style: {
        "max-width": "80px"
      },
      readonly: ""
    }, null, 8 /* PROPS */, _hoisted_143), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.furniture_total.tv]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary me-2",
      onClick: function onClick($event) {
        return unit.furniture_total.tv++;
      }
    }, "+", 8 /* PROPS */, _hoisted_144), _cache[45] || (_cache[45] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" TV "))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_145, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      onClick: function onClick($event) {
        return unit.furniture_total.wardobe > 0 ? unit.furniture_total.wardobe-- : '';
      },
      disabled: unit.furniture_total.wardobe == 0
    }, "−", 8 /* PROPS */, _hoisted_146), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "text",
      id: "wardobe_".concat(index),
      "class": "form-control text-center border-0",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.furniture_total.wardobe = $event;
      },
      value: "0",
      style: {
        "max-width": "80px"
      },
      readonly: ""
    }, null, 8 /* PROPS */, _hoisted_147), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.furniture_total.wardobe]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary me-2",
      onClick: function onClick($event) {
        return unit.furniture_total.wardobe++;
      }
    }, "+", 8 /* PROPS */, _hoisted_148), _cache[46] || (_cache[46] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Wardobe "))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_149, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      onClick: function onClick($event) {
        return unit.furniture_total.sofa > 0 ? unit.furniture_total.sofa-- : '';
      },
      disabled: unit.furniture_total.sofa == 0
    }, "−", 8 /* PROPS */, _hoisted_150), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "text",
      id: "sofa_".concat(index),
      "class": "form-control text-center border-0",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.furniture_total.sofa = $event;
      },
      value: "0",
      style: {
        "max-width": "80px"
      },
      readonly: ""
    }, null, 8 /* PROPS */, _hoisted_151), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, unit.furniture_total.sofa]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary me-2",
      onClick: function onClick($event) {
        return unit.furniture_total.sofa++;
      }
    }, "+", 8 /* PROPS */, _hoisted_152), _cache[47] || (_cache[47] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Sofa "))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_153, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_154, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "washing_machine_".concat(index),
      value: "washing_machine",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_155), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "washing_machine_".concat(index)
    }, "Washing Machine", 8 /* PROPS */, _hoisted_156)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_157, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "stove_".concat(index),
      value: "stove",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_158), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "stove_".concat(index)
    }, "Stove", 8 /* PROPS */, _hoisted_159)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_160, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "fridge_".concat(index),
      value: "fridge",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_161), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "fridge_".concat(index)
    }, "Fridge", 8 /* PROPS */, _hoisted_162)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_163, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "water_purifier_".concat(index),
      value: "water_purifier",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_164), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "water_purifier_".concat(index)
    }, "Water Purifier", 8 /* PROPS */, _hoisted_165)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_166, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "microwave_".concat(index),
      value: "microwave",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_167), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "microwave_".concat(index)
    }, "Microwave", 8 /* PROPS */, _hoisted_168)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_169, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "modular_kitchen_".concat(index),
      value: "modular_kitchen",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_170), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "modular_kitchen_".concat(index)
    }, "Modular Kitchen", 8 /* PROPS */, _hoisted_171)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_172, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "chimney_".concat(index),
      value: "chimney",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_173), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "chimney_".concat(index)
    }, "Chimney", 8 /* PROPS */, _hoisted_174)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_175, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "dinning_table_".concat(index),
      value: "dinning_table",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_176), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "dinning_table_".concat(index)
    }, "Dinning Table", 8 /* PROPS */, _hoisted_177)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_178, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "curtains_".concat(index),
      value: "curtains",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_179), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "curtains_".concat(index)
    }, "Curtains", 8 /* PROPS */, _hoisted_180)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_181, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "exhaust_fan_".concat(index),
      value: "exhaust_fan",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return unit.facilities = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_182), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, unit.facilities]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "exhaust_fan_".concat(index)
    }, "Exhaust Fan", 8 /* PROPS */, _hoisted_183)])])], 64 /* STABLE_FRAGMENT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */)), _cache[49] || (_cache[49] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("hr", {
    "class": "ms-3 mr-3"
  }, null, -1 /* HOISTED */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.data.property_category != 4]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_184, _cache[50] || (_cache[50] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Survey Details", -1 /* HOISTED */)]), 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.data.property_category == 4]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_185, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_186, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.survey_number !== '' ? 'focused' : ''])
  }, [_cache[51] || (_cache[51] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "survey_number"
  }, "Survey Number", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_187, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "survey_number",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.other_details.survey_number = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.survey_number]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_188, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_189, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_190, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.survey_plot_size !== '' ? 'focused' : ''])
  }, [_cache[52] || (_cache[52] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "survey_plot_size"
  }, "Plot size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_191, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "survey_plot_size",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $setup.other_details.survey_plot_size = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.survey_plot_size]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_192, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_193, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_194, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_195)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_196, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.survey_price !== '' ? 'focused' : ''])
  }, [_cache[53] || (_cache[53] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "survey_price"
  }, "Price", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_197, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "survey_price",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $setup.other_details.survey_price = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.survey_price]])])], 2 /* CLASS */)])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.data.property_category == 4]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_198, _cache[54] || (_cache[54] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Tp Details", -1 /* HOISTED */)]), 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.data.property_category == 4]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_199, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_200, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.tp_number !== '' ? 'focused' : ''])
  }, [_cache[55] || (_cache[55] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "tp_number"
  }, "TP Number", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_201, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "tp_number",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $setup.other_details.tp_number = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.tp_number]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_202, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.fp_number !== '' ? 'focused' : ''])
  }, [_cache[56] || (_cache[56] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "fp_number"
  }, "FP Number", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_203, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "fp_number",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $setup.other_details.fp_number = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.fp_number]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_204, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_205, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_206, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.tp_plot_size !== '' ? 'focused' : ''])
  }, [_cache[57] || (_cache[57] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "tp_plot_size"
  }, "Plot size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_207, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "tp_plot_size",
    "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
      return $setup.other_details.tp_plot_size = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.tp_plot_size]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_208, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_209, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_210, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_211)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_212, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.tp_price !== '' ? 'focused' : ''])
  }, [_cache[58] || (_cache[58] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "tp_price"
  }, "Price", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_213, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "tp_price",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $setup.other_details.tp_price = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.tp_price]])])], 2 /* CLASS */)])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.data.property_category == 4]]), _cache[65] || (_cache[65] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "row mt-2"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Owner Information")], -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_214, [_cache[62] || (_cache[62] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"owner_type\"><option value=\"\">Owner</option><option value=\"Builder\">Builder</option><option value=\"Individual\">Individual</option><option value=\"Investor\">Investor</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_215, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.owner_name !== '' ? 'focused' : ''])
  }, [_cache[59] || (_cache[59] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "owner_name"
  }, "Name", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_216, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "owner_name",
    "onUpdate:modelValue": _cache[18] || (_cache[18] = function ($event) {
      return $setup.other_details.owner_name = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.owner_name]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_217, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_218, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_219, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_220, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_221, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.country_codes, function (country) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: country.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(country.country_iso) + "(" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(country.country_code) + ") ", 9 /* TEXT, PROPS */, _hoisted_222);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_223, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.owner_contact !== '' ? 'focused' : ''])
  }, [_cache[60] || (_cache[60] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "owner_contact"
  }, "Contact", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_224, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "owner_contact",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $setup.other_details.owner_contact = $event;
    }),
    style: {
      "border-right": "2px solid #1d2848 !important",
      "border-top-right-radius": "5px",
      "border-bottom-right-radius": "5px"
    }
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.owner_contact]])])], 2 /* CLASS */)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_225, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.owner_email !== '' ? 'focused' : ''])
  }, [_cache[61] || (_cache[61] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "owner_email"
  }, "Email", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_226, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "owner_email",
    "onUpdate:modelValue": _cache[20] || (_cache[20] = function ($event) {
      return $setup.other_details.owner_email = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.owner_email]])])], 2 /* CLASS */)])]), _cache[66] || (_cache[66] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "row mt-3"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Other Contact Details")], -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.other_contact_details, function (other_contact, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_227, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_228, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", other_contact.name !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "other_contact_name_".concat(index)
    }, "Name", 8 /* PROPS */, _hoisted_229), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_230, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "other_contact_name_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return other_contact.name = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_231), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, other_contact.name]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_232, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_233, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_234, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_235, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "class": "form-select",
      id: "contact_code_".concat(index)
    }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.country_codes, function (country) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
        value: country.id
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(country.country_iso) + "(" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(country.country_code) + ") ", 9 /* TEXT, PROPS */, _hoisted_237);
    }), 256 /* UNKEYED_FRAGMENT */))], 8 /* PROPS */, _hoisted_236)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_238, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", other_contact.contact !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "other_contact_contact_".concat(index)
    }, "Contact", 8 /* PROPS */, _hoisted_239), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_240, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "other_contact_contact_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return other_contact.contact = $event;
      },
      style: {
        "border-right": "2px solid #1d2848 !important",
        "border-top-right-radius": "5px",
        "border-bottom-right-radius": "5px"
      }
    }, null, 8 /* PROPS */, _hoisted_241), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, other_contact.contact]])])], 2 /* CLASS */)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_242, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", other_contact.position !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "other_contact_position_".concat(index)
    }, "Position", 8 /* PROPS */, _hoisted_243), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_244, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "other_contact_position_".concat(index),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return other_contact.position = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_245), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, other_contact.position]])])], 2 /* CLASS */)]), index == 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_246, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      type: "button",
      onClick: _cache[21] || (_cache[21] = function ($event) {
        return $setup.addContact();
      })
    }, "+")])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_247, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-danger",
      type: "button",
      onClick: function onClick($event) {
        return $setup.removeContact(index);
      }
    }, "-", 8 /* PROPS */, _hoisted_248)]))]);
  }), 256 /* UNKEYED_FRAGMENT */)), _cache[67] || (_cache[67] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"row gy-2 mt-2\"><div class=\"col-12 col-md-3\"><select class=\"form-select\" id=\"key_available_at\"><option value=\"\">Key Available At</option><option value=\"Office\">Office</option><option value=\"Owner\">Owner</option></select></div></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_249, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_250, [_cache[63] || (_cache[63] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Images : ", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "file",
    multiple: "",
    accept: "image/*",
    "class": "form-control mt-2",
    style: {
      "border": "2px solid",
      "border-radius": "5px"
    },
    onChange: _cache[22] || (_cache[22] = function (e) {
      return $setup.handleFileUpload('image', e);
    })
  }, null, 32 /* NEED_HYDRATION */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_251, [_cache[64] || (_cache[64] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Documents :", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "file",
    multiple: "",
    "class": "form-control mt-2",
    style: {
      "border": "2px solid",
      "border-radius": "5px"
    },
    onChange: _cache[23] || (_cache[23] = function (e) {
      return $setup.handleFileUpload('document', e);
    })
  }, null, 32 /* NEED_HYDRATION */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_252, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_253, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-primary",
    onClick: _cache[24] || (_cache[24] = function ($event) {
      return $setup.submitForm();
    })
  }, "Submit")])])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=template&id=2c688157":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=template&id=2c688157 ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************/
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
  "class": "row gy-2 mt-3"
};
var _hoisted_2 = {
  "class": "col-md-3"
};
var _hoisted_3 = {
  "class": "input-group"
};
var _hoisted_4 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_5 = {
  "class": "fvalue"
};
var _hoisted_6 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_7 = {
  "class": "form-group"
};
var _hoisted_8 = {
  "class": "form-select",
  id: "length_of_plot_unit"
};
var _hoisted_9 = ["value"];
var _hoisted_10 = {
  "class": "col-md-3"
};
var _hoisted_11 = {
  "class": "input-group"
};
var _hoisted_12 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_13 = {
  "class": "fvalue"
};
var _hoisted_14 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_15 = {
  "class": "form-group"
};
var _hoisted_16 = {
  "class": "form-select",
  id: "width_of_plot_unit"
};
var _hoisted_17 = ["value"];
var _hoisted_18 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_19 = {
  "class": "col-12 col-md-2"
};
var _hoisted_20 = {
  "class": "fvalue"
};
var _hoisted_21 = {
  "class": "row mt-2"
};
var _hoisted_22 = {
  "class": "row div_checkboxes1"
};
var _hoisted_23 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_24 = {
  "class": "row mt-2"
};
var _hoisted_25 = {
  "class": "col-md-3"
};
var _hoisted_26 = {
  "class": "input-group"
};
var _hoisted_27 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_28 = {
  "class": "fvalue"
};
var _hoisted_29 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_30 = {
  "class": "form-group"
};
var _hoisted_31 = {
  "class": "form-select",
  id: "road_width_of_front_side_unit"
};
var _hoisted_32 = ["value"];
var _hoisted_33 = {
  "class": "row mt-2"
};
var _hoisted_34 = {
  "class": "col-md-4"
};
var _hoisted_35 = ["id"];
var _hoisted_36 = {
  "class": "col-12 col-md-4"
};
var _hoisted_37 = ["id", "onChange"];
var _hoisted_38 = {
  key: 0,
  "class": "col-md-1 m-b-4 mb-4"
};
var _hoisted_39 = {
  key: 1,
  "class": "col-md-1 m-b-4 mb-4"
};
var _hoisted_40 = ["onClick"];
var _hoisted_41 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_42 = {
  "class": "col-12 col-md-2"
};
var _hoisted_43 = {
  "class": "fvalue"
};
var _hoisted_44 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_45 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_46 = {
  "class": "form-select",
  id: "source"
};
var _hoisted_47 = ["value"];
var _hoisted_48 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_49 = {
  "class": "col-12 col-md-7"
};
var _hoisted_50 = {
  "class": "fvalue"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [_cache[10] || (_cache[10] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Area Size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.length_of_plot !== '' ? 'focused' : ''])
  }, [_cache[8] || (_cache[8] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "length_of_plot"
  }, "Length of plot", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "length_of_plot",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.other_details.length_of_plot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.length_of_plot]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_8, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_9)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.width_of_plot !== '' ? 'focused' : ''])
  }, [_cache[9] || (_cache[9] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "width_of_plot"
  }, "Width of plot", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "width_of_plot",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.other_details.width_of_plot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.width_of_plot]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_16, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_17)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_floors_allowed !== '' ? 'focused' : ''])
  }, [_cache[11] || (_cache[11] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_floors_allowed"
  }, "Number of floors allowed", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_floors_allowed",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.other_details.number_of_floors_allowed = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_floors_allowed]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_hot",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $setup.other_details.is_hot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_hot]]), _cache[12] || (_cache[12] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_hot"
  }, "Hot", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.road_width_of_front_side !== '' ? 'focused' : ''])
  }, [_cache[13] || (_cache[13] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "road_width_of_front_side"
  }, "Road width of front side", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "road_width_of_front_side",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $setup.other_details.road_width_of_front_side = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.road_width_of_front_side]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_30, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_31, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_32)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), _cache[14] || (_cache[14] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-3 m-b-4 mb-4\"><select class=\"form-select\" id=\"construction_allowed_for\"><option value=\"\">Construction allowed for</option><option value=\"\">Residential</option><option value=\"\">Commercial</option><option value=\"\">Industrial</option></select></div>", 1))]), _cache[20] || (_cache[20] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "row mt-5"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Construction Documents")], -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.construction_docs, function (document, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
      "class": "form-select",
      id: "document_category_".concat(index)
    }, _toConsumableArray(_cache[15] || (_cache[15] = [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<option value=\"\"> Category</option><option value=\"1\">Building Elevation</option><option value=\"2\">Common Amenities Photos </option><option value=\"3\">Master Layout Of Building </option><option value=\"4\">Brochure</option><option value=\"5\">Cost Sheet</option><option value=\"6\">Other</option>", 7)])), 8 /* PROPS */, _hoisted_35)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "file",
      id: "document_file_".concat(index),
      onChange: function onChange(e) {
        return $setup.handleFileUpload(e, index);
      },
      name: "",
      "class": "form-control",
      style: {
        "border": "2px solid",
        "border-radius": "5px"
      }
    }, null, 40 /* PROPS, NEED_HYDRATION */, _hoisted_37)]), index == 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-primary",
      type: "button",
      onClick: _cache[5] || (_cache[5] = function ($event) {
        return $setup.addDoc();
      })
    }, "+")])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-danger",
      type: "button",
      onClick: function onClick($event) {
        return $setup.removeDoc(index);
      }
    }, "-", 8 /* PROPS */, _hoisted_40)]))]);
  }), 256 /* UNKEYED_FRAGMENT */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.fsi_far !== '' ? 'focused' : ''])
  }, [_cache[16] || (_cache[16] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "fsi_far"
  }, "FSI / FAR", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "fsi_far",
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return $setup.other_details.fsi_far = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.fsi_far]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [_cache[18] || (_cache[18] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"priority\"><option value=\"\">Priority</option><option value=\"High\">High</option><option value=\"Medium\">Medium</option><option value=\"Low\">Low</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_46, [_cache[17] || (_cache[17] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Source", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_source, function (source) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: source.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(source.name), 9 /* TEXT, PROPS */, _hoisted_47);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.remark !== '' ? 'focused' : ''])
  }, [_cache[19] || (_cache[19] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "remark"
  }, "Property Remark", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "remark",
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $setup.other_details.remark = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.remark]])])], 2 /* CLASS */)])])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=template&id=562aa311":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=template&id=562aa311 ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row gy-2"
};
var _hoisted_2 = {
  "class": "col-md-3"
};
var _hoisted_3 = {
  "class": "input-group"
};
var _hoisted_4 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_5 = {
  "class": "fvalue"
};
var _hoisted_6 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_7 = {
  "class": "form-group"
};
var _hoisted_8 = {
  "class": "form-select",
  id: "saleable_area_unit"
};
var _hoisted_9 = ["value"];
var _hoisted_10 = {
  "class": "col-md-4"
};
var _hoisted_11 = {
  "class": "input-group"
};
var _hoisted_12 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_13 = {
  "class": "fvalue"
};
var _hoisted_14 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_15 = {
  "class": "form-group"
};
var _hoisted_16 = {
  "class": "form-select",
  id: "terrace_saleable_area_unit"
};
var _hoisted_17 = ["value"];
var _hoisted_18 = {
  "class": "row gy-2"
};
var _hoisted_19 = {
  "class": "col"
};
var _hoisted_20 = {
  "for": "add_carpet_area",
  "class": "add-input-link fw-bold"
};
var _hoisted_21 = {
  "for": "add_builtup_area",
  "class": "add-input-link ms-3 fw-bold"
};
var _hoisted_22 = {
  "for": "add_terrace_carpet_area",
  "class": "add-input-link ms-3 fw-bold"
};
var _hoisted_23 = {
  "class": "row gy-3 mt-1"
};
var _hoisted_24 = {
  "class": "col-md-3"
};
var _hoisted_25 = {
  "class": "input-group"
};
var _hoisted_26 = {
  "class": "form-group col-md-7"
};
var _hoisted_27 = {
  "class": "fvalue"
};
var _hoisted_28 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_29 = {
  "class": "form-group"
};
var _hoisted_30 = {
  "class": "form-select",
  id: "carpet_area_unit"
};
var _hoisted_31 = ["value"];
var _hoisted_32 = {
  "class": "col-md-4"
};
var _hoisted_33 = {
  "class": "input-group"
};
var _hoisted_34 = {
  "class": "form-group col-md-7"
};
var _hoisted_35 = {
  "class": "fvalue"
};
var _hoisted_36 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_37 = {
  "class": "form-group"
};
var _hoisted_38 = {
  "class": "form-select",
  id: "built_area_unit"
};
var _hoisted_39 = ["value"];
var _hoisted_40 = {
  "class": "col-md-4"
};
var _hoisted_41 = {
  "class": "input-group"
};
var _hoisted_42 = {
  "class": "form-group col-md-7"
};
var _hoisted_43 = {
  "class": "fvalue"
};
var _hoisted_44 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_45 = {
  "class": "form-group"
};
var _hoisted_46 = {
  "class": "form-select",
  id: "terrace_carpet_area_unit"
};
var _hoisted_47 = ["value"];
var _hoisted_48 = {
  "class": "row gy-4 mt-3"
};
var _hoisted_49 = {
  "class": "col-12 col-md-2"
};
var _hoisted_50 = {
  "class": "fvalue"
};
var _hoisted_51 = {
  "class": "col-12 col-md-2"
};
var _hoisted_52 = {
  "class": "fvalue"
};
var _hoisted_53 = {
  "class": "col-12 col-md-2"
};
var _hoisted_54 = {
  "class": "fvalue"
};
var _hoisted_55 = {
  "class": "col-12 col-md-2"
};
var _hoisted_56 = {
  "class": "fvalue"
};
var _hoisted_57 = {
  "class": "col-12 col-md-2"
};
var _hoisted_58 = {
  "class": "fvalue"
};
var _hoisted_59 = {
  "class": "col-12 col-md-2"
};
var _hoisted_60 = {
  "class": "fvalue"
};
var _hoisted_61 = {
  "class": "col-12 col-md-2"
};
var _hoisted_62 = {
  "class": "fvalue"
};
var _hoisted_63 = {
  "class": "row mt-3"
};
var _hoisted_64 = {
  "class": "row div_checkboxes1"
};
var _hoisted_65 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_66 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_67 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_68 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_69 = {
  "class": "col-12 col-md-2"
};
var _hoisted_70 = {
  "class": "fvalue"
};
var _hoisted_71 = {
  "class": "col-12 col-md-2"
};
var _hoisted_72 = {
  "class": "fvalue"
};
var _hoisted_73 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_74 = {
  "class": "form-select",
  id: "source"
};
var _hoisted_75 = ["value"];
var _hoisted_76 = {
  "class": "row mt-2"
};
var _hoisted_77 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_78 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_79 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_80 = {
  key: 0,
  "class": "row mt-2"
};
var _hoisted_81 = {
  key: 0,
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_82 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_83 = ["value", "id"];
var _hoisted_84 = ["for"];
var _hoisted_85 = {
  key: 1,
  "class": "col-12 col-md-2"
};
var _hoisted_86 = {
  "class": "fvalue"
};
var _hoisted_87 = {
  "class": "row mt-3"
};
var _hoisted_88 = {
  "class": "row div_checkboxes1"
};
var _hoisted_89 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_90 = {
  key: 1,
  "class": "row mt-3"
};
var _hoisted_91 = {
  "class": "row div_checkboxes1 mt-2 gy-3"
};
var _hoisted_92 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_93 = ["onUpdate:modelValue", "id", "value"];
var _hoisted_94 = ["for"];
var _hoisted_95 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_96 = {
  "class": "col-12 col-md-7"
};
var _hoisted_97 = {
  "class": "fvalue"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [_cache[34] || (_cache[34] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Area Size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.saleable_area !== '' ? 'focused' : ''])
  }, [_cache[32] || (_cache[32] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "saleable_area"
  }, "Saleble Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "saleable_area",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.other_details.saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_8, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_9)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.terrace_saleable_area !== '' ? 'focused' : ''])
  }, [_cache[33] || (_cache[33] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "terrace_saleable_area"
  }, "Terrace Saleable Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "terrace_saleable_area",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.other_details.terrace_saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.terrace_saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_16, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_17)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_20, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_carpet_area != 1 ? '+ Add' : '- Remove') + " Carpet Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.other_details.add_carpet_area = $event;
    }),
    onChange: _cache[3] || (_cache[3] = function ($event) {
      return $setup.resetValue(['carpet_area', 'carpet_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_carpet_area]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_21, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_builtup_area != 1 ? '+ Add' : '- Remove') + " Builtup Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_builtup_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $setup.other_details.add_builtup_area = $event;
    }),
    onChange: _cache[5] || (_cache[5] = function ($event) {
      return $setup.resetValue(['built_area', 'built_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_builtup_area]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_22, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_terrace_carpet_area != 1 ? '+ Add' : '- Remove') + " terrace Carpet Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_terrace_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return $setup.other_details.add_terrace_carpet_area = $event;
    }),
    onChange: _cache[7] || (_cache[7] = function ($event) {
      return $setup.resetValue(['terrace_carpet_area', 'terrace_carpet_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_terrace_carpet_area]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.carpet_area !== '' ? 'focused' : ''])
  }, [_cache[35] || (_cache[35] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "carpet_area"
  }, "Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "carpet_area",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $setup.other_details.carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_30, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_31)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_carpet_area == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.built_area !== '' ? 'focused' : ''])
  }, [_cache[36] || (_cache[36] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "built_area"
  }, "Builtup Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "built_area",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.other_details.built_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.built_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_38, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_39)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_builtup_area == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.terrace_carpet_area !== '' ? 'focused' : ''])
  }, [_cache[37] || (_cache[37] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "terrace_carpet_area"
  }, "Terrace Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "terrace_carpet_area",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $setup.other_details.terrace_carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.terrace_carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_46, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_47)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_terrace_carpet_area == 1]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_project !== '' ? 'focused' : ''])
  }, [_cache[38] || (_cache[38] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_project"
  }, "Units in project", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_project",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.other_details.units_in_project = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_project]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_51, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_floor !== '' ? 'focused' : ''])
  }, [_cache[39] || (_cache[39] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_floor"
  }, "No. of floor", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_floor",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $setup.other_details.number_of_floor = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_floor]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_towers !== '' ? 'focused' : ''])
  }, [_cache[40] || (_cache[40] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_towers"
  }, "Units in tower", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_towers",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $setup.other_details.units_in_towers = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_towers]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_55, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_on_floor !== '' ? 'focused' : ''])
  }, [_cache[41] || (_cache[41] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_on_floor"
  }, "Units on floor", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_on_floor",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $setup.other_details.units_on_floor = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_on_floor]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_elevators !== '' ? 'focused' : ''])
  }, [_cache[42] || (_cache[42] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_elevators"
  }, "No. of elevators", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_elevators",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $setup.other_details.number_of_elevators = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_elevators]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_balcony !== '' ? 'focused' : ''])
  }, [_cache[43] || (_cache[43] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_balcony"
  }, "No. of Balcony", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_balcony",
    "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
      return $setup.other_details.number_of_balcony = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_balcony]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_bathrooms !== '' ? 'focused' : ''])
  }, [_cache[44] || (_cache[44] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_bathrooms"
  }, "Number of bathrooms", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_bathrooms",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $setup.other_details.number_of_bathrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_bathrooms]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_63, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_64, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "service_elevator",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[18] || (_cache[18] = function ($event) {
      return $setup.other_details.service_elevator = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.service_elevator]]), _cache[45] || (_cache[45] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "service_elevator"
  }, "Service Elevator", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_66, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "servent_room",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $setup.other_details.servent_room = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.servent_room]]), _cache[46] || (_cache[46] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "servent_room"
  }, "Servent Room", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_hot",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[20] || (_cache[20] = function ($event) {
      return $setup.other_details.is_hot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_hot]]), _cache[47] || (_cache[47] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_hot"
  }, "Hot", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_68, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.four_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[48] || (_cache[48] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "four_wheeler_parking"
  }, "Four wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "four_wheeler_parking",
    "onUpdate:modelValue": _cache[21] || (_cache[21] = function ($event) {
      return $setup.other_details.four_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.four_wheeler_parking]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.two_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[49] || (_cache[49] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "two_wheeler_parking"
  }, "Two wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_72, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "two_wheeler_parking",
    "onUpdate:modelValue": _cache[22] || (_cache[22] = function ($event) {
      return $setup.other_details.two_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.two_wheeler_parking]])])], 2 /* CLASS */)]), _cache[51] || (_cache[51] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"priority\"><option value=\"\">Priority</option><option value=\"High\">High</option><option value=\"Medium\">Medium</option><option value=\"Low\">Low</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_74, [_cache[50] || (_cache[50] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Source", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_source, function (source) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: source.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(source.name), 9 /* TEXT, PROPS */, _hoisted_75);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_76, [_cache[54] || (_cache[54] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Availability Status", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_77, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_78, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Available",
    name: "availability_status",
    id: "available",
    "onUpdate:modelValue": _cache[23] || (_cache[23] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[24] || (_cache[24] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[52] || (_cache[52] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "available"
  }, "Available", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_79, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Under Construction",
    name: "availability_status",
    id: "under_con",
    "onUpdate:modelValue": _cache[25] || (_cache[25] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[26] || (_cache[26] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[53] || (_cache[53] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "under_con"
  }, "Under Construction", -1 /* HOISTED */))])])]), $setup.other_details.availability_status ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_80, [$setup.other_details.availability_status == 'Available' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_81, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.age_of_property, function (age) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_82, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "radio",
      "class": "btn-check",
      value: age,
      name: "age_of_property",
      id: "age-".concat(age),
      "onUpdate:modelValue": _cache[27] || (_cache[27] = function ($event) {
        return $setup.other_details.age_of_property = $event;
      })
    }, null, 8 /* PROPS */, _hoisted_83), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.age_of_property]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "btn btn-outline-primary btn-pill btn-sm py-1",
      "for": "age-".concat(age)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(age), 9 /* TEXT, PROPS */, _hoisted_84)]);
  }), 64 /* STABLE_FRAGMENT */))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $setup.other_details.availability_status == 'Under Construction' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_85, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.available_from !== '' ? 'focused' : ''])
  }, [_cache[55] || (_cache[55] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "available_from"
  }, "Available From", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_86, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "available_from",
    "onUpdate:modelValue": _cache[28] || (_cache[28] = function ($event) {
      return $setup.other_details.available_from = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.available_from]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_87, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_88, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_89, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_have_amenities",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[29] || (_cache[29] = function ($event) {
      return $setup.other_details.is_have_amenities = $event;
    }),
    onChange: _cache[30] || (_cache[30] = function ($event) {
      return $setup.other_details.amenities = [];
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_have_amenities]]), _cache[56] || (_cache[56] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_have_amenities"
  }, "Amenities", -1 /* HOISTED */))])])]), $setup.other_details.is_have_amenities ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_90, [_cache[57] || (_cache[57] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Amenities", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_91, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.amenities, function (amenity) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_92, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)(((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("input", {
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return $setup.other_details.amenities[amenity.id] = $event;
      },
      "class": "form-check-input",
      id: "amenity-".concat(amenity.id),
      key: "amenity-".concat(amenity.id),
      value: amenity.id,
      type: "checkbox"
    }, null, 8 /* PROPS */, _hoisted_93)), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.amenities[amenity.id]]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "amenity-".concat(amenity.id)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(amenity.name), 9 /* TEXT, PROPS */, _hoisted_94)]);
  }), 256 /* UNKEYED_FRAGMENT */))])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_96, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.remark !== '' ? 'focused' : ''])
  }, [_cache[58] || (_cache[58] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "remark"
  }, "Property Remark", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_97, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "remark",
    "onUpdate:modelValue": _cache[31] || (_cache[31] = function ($event) {
      return $setup.other_details.remark = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.remark]])])], 2 /* CLASS */)])])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=template&id=2cd9b366":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=template&id=2cd9b366 ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_2 = {
  "class": "col-md-3"
};
var _hoisted_3 = {
  "class": "input-group"
};
var _hoisted_4 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_5 = {
  "class": "fvalue"
};
var _hoisted_6 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_7 = {
  "class": "form-group"
};
var _hoisted_8 = {
  "class": "form-select",
  id: "saleable_area_unit"
};
var _hoisted_9 = ["value"];
var _hoisted_10 = {
  "class": "col-md-3"
};
var _hoisted_11 = {
  "class": "input-group"
};
var _hoisted_12 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_13 = {
  "class": "fvalue"
};
var _hoisted_14 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_15 = {
  "class": "form-group"
};
var _hoisted_16 = {
  "class": "form-select",
  id: "length_of_plot_unit"
};
var _hoisted_17 = ["value"];
var _hoisted_18 = {
  "class": "col-md-3"
};
var _hoisted_19 = {
  "class": "input-group"
};
var _hoisted_20 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_21 = {
  "class": "fvalue"
};
var _hoisted_22 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_23 = {
  "class": "form-group"
};
var _hoisted_24 = {
  "class": "form-select",
  id: "width_of_plot_unit"
};
var _hoisted_25 = ["value"];
var _hoisted_26 = {
  "class": "col-md-3"
};
var _hoisted_27 = {
  "class": "input-group"
};
var _hoisted_28 = {
  "class": "form-group col-md-7"
};
var _hoisted_29 = {
  "class": "fvalue"
};
var _hoisted_30 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_31 = {
  "class": "form-group"
};
var _hoisted_32 = {
  "class": "form-select",
  id: "carpet_plot_area_unit"
};
var _hoisted_33 = ["value"];
var _hoisted_34 = {
  "class": "row gy-2"
};
var _hoisted_35 = {
  "class": "col"
};
var _hoisted_36 = {
  "for": "add_carpet_plot_area",
  "class": "add-input-link fw-bold"
};
var _hoisted_37 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_38 = {
  "class": "col-12 col-md-3"
};
var _hoisted_39 = {
  "class": "fvalue"
};
var _hoisted_40 = {
  "class": "col-12 col-md-3"
};
var _hoisted_41 = {
  "class": "fvalue"
};
var _hoisted_42 = {
  "class": "col-12 col-md-3"
};
var _hoisted_43 = {
  "class": "fvalue"
};
var _hoisted_44 = {
  "class": "row mt-3"
};
var _hoisted_45 = {
  "class": "row div_checkboxes1"
};
var _hoisted_46 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_47 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_48 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_49 = {
  "class": "form-select",
  id: "source"
};
var _hoisted_50 = ["value"];
var _hoisted_51 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_52 = {
  "class": "col-12 col-md-7"
};
var _hoisted_53 = {
  "class": "fvalue"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [_cache[15] || (_cache[15] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Area Size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.saleable_area !== '' ? 'focused' : ''])
  }, [_cache[11] || (_cache[11] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "saleable_area"
  }, "Saleable Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "saleable_area",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.other_details.saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_8, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_9)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.length_of_plot !== '' ? 'focused' : ''])
  }, [_cache[12] || (_cache[12] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "length_of_plot"
  }, "Length of plot", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "length_of_plot",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.other_details.length_of_plot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.length_of_plot]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_16, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_17)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.width_of_plot !== '' ? 'focused' : ''])
  }, [_cache[13] || (_cache[13] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "width_of_plot"
  }, "Width of plot", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "width_of_plot",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.other_details.width_of_plot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.width_of_plot]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_24, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_25)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.carpet_plot_area !== '' ? 'focused' : ''])
  }, [_cache[14] || (_cache[14] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "carpet_plot_area"
  }, "Carpet Plot Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "carpet_plot_area",
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $setup.other_details.carpet_plot_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.carpet_plot_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_30, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_31, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_32, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_33)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_carpet_plot_area == 1]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_36, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_carpet_plot_area != 1 ? '+ Add' : '- Remove') + " Carpet Plot Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_carpet_plot_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $setup.other_details.add_carpet_plot_area = $event;
    }),
    onChange: _cache[5] || (_cache[5] = function ($event) {
      return $setup.resetValue(['carpet_plot_area', 'carpet_plot_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_carpet_plot_area]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_units !== '' ? 'focused' : ''])
  }, [_cache[16] || (_cache[16] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_units"
  }, "No. of units", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_units",
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return $setup.other_details.number_of_units = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_units]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_floors_allowed !== '' ? 'focused' : ''])
  }, [_cache[17] || (_cache[17] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_floors_allowed"
  }, "No. of floors allowed", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_floors_allowed",
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $setup.other_details.number_of_floors_allowed = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_floors_allowed]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_open_side !== '' ? 'focused' : ''])
  }, [_cache[18] || (_cache[18] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_open_side"
  }, "No. of open side", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_open_side",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $setup.other_details.number_of_open_side = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_open_side]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_hot",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.other_details.is_hot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_hot]]), _cache[19] || (_cache[19] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_hot"
  }, "Hot", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_47, [_cache[21] || (_cache[21] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"priority\"><option value=\"\">Priority</option><option value=\"High\">High</option><option value=\"Medium\">Medium</option><option value=\"Low\">Low</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_49, [_cache[20] || (_cache[20] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Source", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_source, function (source) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: source.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(source.name), 9 /* TEXT, PROPS */, _hoisted_50);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_51, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.remark !== '' ? 'focused' : ''])
  }, [_cache[22] || (_cache[22] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "remark"
  }, "Property Remark", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "remark",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $setup.other_details.remark = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.remark]])])], 2 /* CLASS */)])])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=template&id=72a2f988":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=template&id=72a2f988 ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row gy-2"
};
var _hoisted_2 = {
  "class": "col-md-3"
};
var _hoisted_3 = {
  "class": "input-group"
};
var _hoisted_4 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_5 = {
  "class": "fvalue"
};
var _hoisted_6 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_7 = {
  "class": "form-group"
};
var _hoisted_8 = {
  "class": "form-select",
  id: "saleable_plot_area_unit"
};
var _hoisted_9 = ["value"];
var _hoisted_10 = {
  "class": "col-md-4"
};
var _hoisted_11 = {
  "class": "input-group"
};
var _hoisted_12 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_13 = {
  "class": "fvalue"
};
var _hoisted_14 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_15 = {
  "class": "form-group"
};
var _hoisted_16 = {
  "class": "form-select",
  id: "saleable_constructed_area_unit"
};
var _hoisted_17 = ["value"];
var _hoisted_18 = {
  "class": "row gy-2"
};
var _hoisted_19 = {
  "class": "col"
};
var _hoisted_20 = {
  "for": "add_carpet_plot_area",
  "class": "add-input-link fw-bold"
};
var _hoisted_21 = {
  "for": "add_constructed_carpet_area",
  "class": "add-input-link ms-3 fw-bold"
};
var _hoisted_22 = {
  "for": "add_constructed_builtup_area",
  "class": "add-input-link ms-3 fw-bold"
};
var _hoisted_23 = {
  "class": "row gy-3 mt-1"
};
var _hoisted_24 = {
  "class": "col-md-3"
};
var _hoisted_25 = {
  "class": "input-group"
};
var _hoisted_26 = {
  "class": "form-group col-md-7"
};
var _hoisted_27 = {
  "class": "fvalue"
};
var _hoisted_28 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_29 = {
  "class": "form-group"
};
var _hoisted_30 = {
  "class": "form-select",
  id: "carpet_plot_area_unit"
};
var _hoisted_31 = ["value"];
var _hoisted_32 = {
  "class": "col-md-4"
};
var _hoisted_33 = {
  "class": "input-group"
};
var _hoisted_34 = {
  "class": "form-group col-md-7"
};
var _hoisted_35 = {
  "class": "fvalue"
};
var _hoisted_36 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_37 = {
  "class": "form-group"
};
var _hoisted_38 = {
  "class": "form-select",
  id: "constructed_carpet_area_unit"
};
var _hoisted_39 = ["value"];
var _hoisted_40 = {
  "class": "col-md-4"
};
var _hoisted_41 = {
  "class": "input-group"
};
var _hoisted_42 = {
  "class": "form-group col-md-7"
};
var _hoisted_43 = {
  "class": "fvalue"
};
var _hoisted_44 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_45 = {
  "class": "form-group"
};
var _hoisted_46 = {
  "class": "form-select",
  id: "constructed_builtup_area_unit"
};
var _hoisted_47 = ["value"];
var _hoisted_48 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_49 = {
  "class": "col-12 col-md-2"
};
var _hoisted_50 = {
  "class": "fvalue"
};
var _hoisted_51 = {
  "class": "col-12 col-md-2"
};
var _hoisted_52 = {
  "class": "fvalue"
};
var _hoisted_53 = {
  "class": "col-12 col-md-2"
};
var _hoisted_54 = {
  "class": "fvalue"
};
var _hoisted_55 = {
  "class": "col-12 col-md-2"
};
var _hoisted_56 = {
  "class": "fvalue"
};
var _hoisted_57 = {
  "class": "row mt-3"
};
var _hoisted_58 = {
  "class": "row div_checkboxes1"
};
var _hoisted_59 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_60 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_61 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_62 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_63 = {
  "class": "col-12 col-md-2"
};
var _hoisted_64 = {
  "class": "fvalue"
};
var _hoisted_65 = {
  "class": "col-12 col-md-2"
};
var _hoisted_66 = {
  "class": "fvalue"
};
var _hoisted_67 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_68 = {
  "class": "form-select",
  id: "source"
};
var _hoisted_69 = ["value"];
var _hoisted_70 = {
  "class": "row mt-2"
};
var _hoisted_71 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_72 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_73 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_74 = {
  key: 0,
  "class": "row mt-2"
};
var _hoisted_75 = {
  key: 0,
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_76 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_77 = ["value", "id"];
var _hoisted_78 = ["for"];
var _hoisted_79 = {
  key: 1,
  "class": "col-12 col-md-2"
};
var _hoisted_80 = {
  "class": "fvalue"
};
var _hoisted_81 = {
  "class": "row mt-3"
};
var _hoisted_82 = {
  "class": "row div_checkboxes1"
};
var _hoisted_83 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_84 = {
  key: 1,
  "class": "row mt-3"
};
var _hoisted_85 = {
  "class": "row div_checkboxes1 mt-2 gy-3"
};
var _hoisted_86 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_87 = ["onUpdate:modelValue", "id", "value"];
var _hoisted_88 = ["for"];
var _hoisted_89 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_90 = {
  "class": "col-12 col-md-7"
};
var _hoisted_91 = {
  "class": "fvalue"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [_cache[31] || (_cache[31] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Area Size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.saleable_plot_area !== '' ? 'focused' : ''])
  }, [_cache[29] || (_cache[29] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "saleable_plot_area"
  }, "Saleble Plot Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "saleable_plot_area",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.other_details.saleable_plot_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.saleable_plot_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_8, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_9)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.saleable_constructed_area !== '' ? 'focused' : ''])
  }, [_cache[30] || (_cache[30] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "saleable_constructed_area"
  }, "Saleable constructed Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "saleable_constructed_area",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.other_details.saleable_constructed_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.saleable_constructed_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_16, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_17)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_20, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_carpet_plot_area != 1 ? '+ Add' : '- Remove') + " Carpet Plot Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_carpet_plot_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.other_details.add_carpet_plot_area = $event;
    }),
    onChange: _cache[3] || (_cache[3] = function ($event) {
      return $setup.resetValue(['carpet_plot_area', 'carpet_plot_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_carpet_plot_area]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_21, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_constructed_carpet_area != 1 ? '+ Add' : '- Remove') + " Constructed Carpet Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_constructed_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $setup.other_details.add_constructed_carpet_area = $event;
    }),
    onChange: _cache[5] || (_cache[5] = function ($event) {
      return $setup.resetValue(['constructed_carpet_area', 'constructed_carpet_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_constructed_carpet_area]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_22, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_constructed_builtup_area != 1 ? '+ Add' : '- Remove') + " Constructed Builtup Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_constructed_builtup_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return $setup.other_details.add_constructed_builtup_area = $event;
    }),
    onChange: _cache[7] || (_cache[7] = function ($event) {
      return $setup.resetValue(['constructed_builtup_area', 'constructed_builtup_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_constructed_builtup_area]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.carpet_plot_area !== '' ? 'focused' : ''])
  }, [_cache[32] || (_cache[32] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "carpet_plot_area"
  }, "Carpet Plot Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "carpet_plot_area",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $setup.other_details.carpet_plot_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.carpet_plot_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_30, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_31)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_carpet_plot_area == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.constructed_carpet_area !== '' ? 'focused' : ''])
  }, [_cache[33] || (_cache[33] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "constructed_carpet_area"
  }, "Constructed Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "constructed_carpet_area",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.other_details.constructed_carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.constructed_carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_38, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_39)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_constructed_carpet_area == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.constructed_builtup_area !== '' ? 'focused' : ''])
  }, [_cache[34] || (_cache[34] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "constructed_builtup_area"
  }, "Constructed Builtup Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "constructed_builtup_area",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $setup.other_details.constructed_builtup_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.constructed_builtup_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_46, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_47)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_constructed_builtup_area == 1]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_balcony !== '' ? 'focused' : ''])
  }, [_cache[35] || (_cache[35] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_balcony"
  }, "No. of Balcony", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_balcony",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.other_details.number_of_balcony = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_balcony]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_51, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_units !== '' ? 'focused' : ''])
  }, [_cache[36] || (_cache[36] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_units"
  }, "No. of units", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_units",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $setup.other_details.number_of_units = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_units]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_bathrooms !== '' ? 'focused' : ''])
  }, [_cache[37] || (_cache[37] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_bathrooms"
  }, "Number of bathrooms", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_bathrooms",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $setup.other_details.number_of_bathrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_bathrooms]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_55, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_open_side !== '' ? 'focused' : ''])
  }, [_cache[38] || (_cache[38] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_open_side"
  }, "No. of open side", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_open_side",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $setup.other_details.number_of_open_side = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_open_side]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "servent_room",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $setup.other_details.servent_room = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.servent_room]]), _cache[39] || (_cache[39] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "servent_room"
  }, "Servent Room", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_hot",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
      return $setup.other_details.is_hot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_hot]]), _cache[40] || (_cache[40] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_hot"
  }, "Hot", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "weekend",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $setup.other_details.weekend = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.weekend]]), _cache[41] || (_cache[41] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "weekend"
  }, "Weekend", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_63, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.four_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[42] || (_cache[42] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "four_wheeler_parking"
  }, "Four wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_64, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "four_wheeler_parking",
    "onUpdate:modelValue": _cache[18] || (_cache[18] = function ($event) {
      return $setup.other_details.four_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.four_wheeler_parking]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.two_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[43] || (_cache[43] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "two_wheeler_parking"
  }, "Two wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_66, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "two_wheeler_parking",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $setup.other_details.two_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.two_wheeler_parking]])])], 2 /* CLASS */)]), _cache[45] || (_cache[45] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"priority\"><option value=\"\">Priority</option><option value=\"High\">High</option><option value=\"Medium\">Medium</option><option value=\"Low\">Low</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_68, [_cache[44] || (_cache[44] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Source", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_source, function (source) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: source.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(source.name), 9 /* TEXT, PROPS */, _hoisted_69);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [_cache[48] || (_cache[48] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Availability Status", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_72, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Available",
    name: "availability_status",
    id: "available",
    "onUpdate:modelValue": _cache[20] || (_cache[20] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[21] || (_cache[21] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[46] || (_cache[46] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "available"
  }, "Available", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Under Construction",
    name: "availability_status",
    id: "under_con",
    "onUpdate:modelValue": _cache[22] || (_cache[22] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[23] || (_cache[23] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[47] || (_cache[47] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "under_con"
  }, "Under Construction", -1 /* HOISTED */))])])]), $setup.other_details.availability_status ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_74, [$setup.other_details.availability_status == 'Available' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_75, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.age_of_property, function (age) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_76, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "radio",
      "class": "btn-check",
      value: age,
      name: "age_of_property",
      id: "age-".concat(age),
      "onUpdate:modelValue": _cache[24] || (_cache[24] = function ($event) {
        return $setup.other_details.age_of_property = $event;
      })
    }, null, 8 /* PROPS */, _hoisted_77), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.age_of_property]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "btn btn-outline-primary btn-pill btn-sm py-1",
      "for": "age-".concat(age)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(age), 9 /* TEXT, PROPS */, _hoisted_78)]);
  }), 64 /* STABLE_FRAGMENT */))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $setup.other_details.availability_status == 'Under Construction' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_79, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.available_from !== '' ? 'focused' : ''])
  }, [_cache[49] || (_cache[49] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "available_from"
  }, "Available From", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_80, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "available_from",
    "onUpdate:modelValue": _cache[25] || (_cache[25] = function ($event) {
      return $setup.other_details.available_from = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.available_from]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_81, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_82, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_83, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_have_amenities",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[26] || (_cache[26] = function ($event) {
      return $setup.other_details.is_have_amenities = $event;
    }),
    onChange: _cache[27] || (_cache[27] = function ($event) {
      return $setup.other_details.amenities = [];
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_have_amenities]]), _cache[50] || (_cache[50] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_have_amenities"
  }, "Amenities", -1 /* HOISTED */))])])]), $setup.other_details.is_have_amenities ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_84, [_cache[51] || (_cache[51] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Amenities", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_85, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.amenities, function (amenity) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_86, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)(((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("input", {
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return $setup.other_details.amenities[amenity.id] = $event;
      },
      "class": "form-check-input",
      id: "amenity-".concat(amenity.id),
      key: "amenity-".concat(amenity.id),
      value: amenity.id,
      type: "checkbox"
    }, null, 8 /* PROPS */, _hoisted_87)), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.amenities[amenity.id]]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "amenity-".concat(amenity.id)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(amenity.name), 9 /* TEXT, PROPS */, _hoisted_88)]);
  }), 256 /* UNKEYED_FRAGMENT */))])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_89, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_90, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.remark !== '' ? 'focused' : ''])
  }, [_cache[52] || (_cache[52] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "remark"
  }, "Property Remark", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_91, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "remark",
    "onUpdate:modelValue": _cache[28] || (_cache[28] = function ($event) {
      return $setup.other_details.remark = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.remark]])])], 2 /* CLASS */)])])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=template&id=36d32cc5":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=template&id=36d32cc5 ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row gy-2"
};
var _hoisted_2 = {
  "class": "col-md-3"
};
var _hoisted_3 = {
  "class": "input-group"
};
var _hoisted_4 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_5 = {
  "class": "fvalue"
};
var _hoisted_6 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_7 = {
  "class": "form-group"
};
var _hoisted_8 = {
  "class": "form-select",
  id: "saleable_area_unit"
};
var _hoisted_9 = ["value"];
var _hoisted_10 = {
  "class": "col-md-3"
};
var _hoisted_11 = {
  "class": "input-group"
};
var _hoisted_12 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_13 = {
  "class": "fvalue"
};
var _hoisted_14 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_15 = {
  "class": "form-group"
};
var _hoisted_16 = {
  "class": "form-select",
  id: "builtup_area_unit"
};
var _hoisted_17 = ["value"];
var _hoisted_18 = {
  "class": "col-md-3"
};
var _hoisted_19 = {
  "class": "input-group"
};
var _hoisted_20 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_21 = {
  "class": "fvalue"
};
var _hoisted_22 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_23 = {
  "class": "form-group"
};
var _hoisted_24 = {
  "class": "form-select",
  id: "opening_width_unit"
};
var _hoisted_25 = ["value"];
var _hoisted_26 = {
  "class": "col-md-3"
};
var _hoisted_27 = {
  "class": "form-check checkbox checkbox-solid-success"
};
var _hoisted_28 = {
  "class": "row gy-2"
};
var _hoisted_29 = {
  "class": "col"
};
var _hoisted_30 = {
  "for": "add_carpet_area",
  "class": "add-input-link fw-bold"
};
var _hoisted_31 = {
  key: 0,
  "for": "add_terrace_carpet_area",
  "class": "add-input-link ms-3 fw-bold"
};
var _hoisted_32 = {
  "class": "row gy-2 mt-1"
};
var _hoisted_33 = {
  "class": "col-md-4"
};
var _hoisted_34 = {
  "class": "input-group"
};
var _hoisted_35 = {
  "class": "form-group col-md-7"
};
var _hoisted_36 = {
  "class": "fvalue"
};
var _hoisted_37 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_38 = {
  "class": "form-group"
};
var _hoisted_39 = {
  "class": "form-select",
  id: "carpet_area_unit"
};
var _hoisted_40 = ["value"];
var _hoisted_41 = {
  "class": "col-md-4"
};
var _hoisted_42 = {
  "class": "input-group"
};
var _hoisted_43 = {
  "class": "form-group col-md-7"
};
var _hoisted_44 = {
  "class": "fvalue"
};
var _hoisted_45 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_46 = {
  "class": "form-group"
};
var _hoisted_47 = {
  "class": "form-select",
  id: "terrace_saleable_area_unit"
};
var _hoisted_48 = ["value"];
var _hoisted_49 = {
  "class": "col-md-4"
};
var _hoisted_50 = {
  "class": "input-group"
};
var _hoisted_51 = {
  "class": "form-group col-md-7"
};
var _hoisted_52 = {
  "class": "fvalue"
};
var _hoisted_53 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_54 = {
  "class": "form-group"
};
var _hoisted_55 = {
  "class": "form-select",
  id: "terrace_carpet_area_unit"
};
var _hoisted_56 = ["value"];
var _hoisted_57 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_58 = {
  "class": "col-12 col-md-2"
};
var _hoisted_59 = {
  "class": "fvalue"
};
var _hoisted_60 = {
  "class": "col-12 col-md-2"
};
var _hoisted_61 = {
  "class": "fvalue"
};
var _hoisted_62 = {
  "class": "col-12 col-md-2"
};
var _hoisted_63 = {
  "class": "fvalue"
};
var _hoisted_64 = {
  "class": "col-12 col-md-2"
};
var _hoisted_65 = {
  "class": "fvalue"
};
var _hoisted_66 = {
  "class": "col-12 col-md-2"
};
var _hoisted_67 = {
  "class": "fvalue"
};
var _hoisted_68 = {
  "class": "col-12 col-md-2"
};
var _hoisted_69 = {
  "class": "fvalue"
};
var _hoisted_70 = {
  "class": "row mt-3"
};
var _hoisted_71 = {
  "class": "row div_checkboxes1"
};
var _hoisted_72 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_73 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_74 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_75 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_76 = {
  "class": "col-12 col-md-2"
};
var _hoisted_77 = {
  "class": "fvalue"
};
var _hoisted_78 = {
  "class": "col-12 col-md-2"
};
var _hoisted_79 = {
  "class": "fvalue"
};
var _hoisted_80 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_81 = {
  "class": "form-select",
  id: "source"
};
var _hoisted_82 = ["value"];
var _hoisted_83 = {
  "class": "row mt-2"
};
var _hoisted_84 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_85 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_86 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_87 = {
  key: 0,
  "class": "row mt-2"
};
var _hoisted_88 = {
  key: 0,
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_89 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_90 = ["value", "id"];
var _hoisted_91 = ["for"];
var _hoisted_92 = {
  key: 1,
  "class": "col-12 col-md-2"
};
var _hoisted_93 = {
  "class": "fvalue"
};
var _hoisted_94 = {
  "class": "row mt-3"
};
var _hoisted_95 = {
  "class": "row div_checkboxes1"
};
var _hoisted_96 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_97 = {
  key: 1,
  "class": "row mt-3"
};
var _hoisted_98 = {
  "class": "row div_checkboxes1 mt-2 gy-3"
};
var _hoisted_99 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_100 = ["onUpdate:modelValue", "id", "value"];
var _hoisted_101 = ["for"];
var _hoisted_102 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_103 = {
  "class": "col-12 col-md-7"
};
var _hoisted_104 = {
  "class": "fvalue"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [_cache[36] || (_cache[36] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Area Size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.saleable_area !== '' ? 'focused' : ''])
  }, [_cache[32] || (_cache[32] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "saleable_area"
  }, "Saleble Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "saleable_area",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.other_details.saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_8, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_9)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.builtup_area !== '' ? 'focused' : ''])
  }, [_cache[33] || (_cache[33] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "builtup_area"
  }, "Builtup Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "builtup_area",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.other_details.builtup_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.builtup_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_16, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_17)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.opening_width !== '' ? 'focused' : ''])
  }, [_cache[34] || (_cache[34] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "opening_width"
  }, "Opening Width", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "opening_width",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.other_details.opening_width = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.opening_width]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_24, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_25)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.props.property_category == 2]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_terrace",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $setup.other_details.is_terrace = $event;
    }),
    onClick: _cache[4] || (_cache[4] = function ($event) {
      return $setup.resetValue(['terrace_saleable_area', 'terrace_saleable_area_unit', 'terrace_carpet_area', 'terrace_carpet_area_unit']);
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_terrace]]), _cache[35] || (_cache[35] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_terrace"
  }, "Terrace", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_30, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_carpet_area != 1 ? '+ Add' : '- Remove') + " Carpet Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return $setup.other_details.add_carpet_area = $event;
    }),
    onChange: _cache[6] || (_cache[6] = function ($event) {
      return $setup.resetValue(['carpet_area', 'carpet_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_carpet_area]]), $setup.other_details.is_terrace == 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("label", _hoisted_31, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_terrace_carpet_area != 1 ? '+ Add' : '- Remove') + " Terrace Carpet Area", 1 /* TEXT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_terrace_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $setup.other_details.add_terrace_carpet_area = $event;
    }),
    onChange: _cache[8] || (_cache[8] = function ($event) {
      return $setup.resetValue(['terrace_carpet_area', 'terrace_carpet_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_terrace_carpet_area]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.carpet_area !== '' ? 'focused' : ''])
  }, [_cache[37] || (_cache[37] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "carpet_area"
  }, "Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "carpet_area",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.other_details.carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_39, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_40)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_carpet_area == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.terrace_saleable_area !== '' ? 'focused' : ''])
  }, [_cache[38] || (_cache[38] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "terrace_saleable_area"
  }, "Terrace Saleable Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "terrace_saleable_area",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $setup.other_details.terrace_saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.terrace_saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_47, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_48)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.is_terrace == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_51, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.terrace_carpet_area !== '' ? 'focused' : ''])
  }, [_cache[39] || (_cache[39] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "terrace_carpet_area"
  }, "Terrace Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "terrace_carpet_area",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.other_details.terrace_carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.terrace_carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_55, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_56)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_terrace_carpet_area == 1 && $setup.other_details.is_terrace == 1]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_project !== '' ? 'focused' : ''])
  }, [_cache[40] || (_cache[40] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_project"
  }, "Units in project", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_project",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $setup.other_details.units_in_project = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_project]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_floor !== '' ? 'focused' : ''])
  }, [_cache[41] || (_cache[41] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_floor"
  }, "Number of floor", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_floor",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $setup.other_details.number_of_floor = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_floor]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_towers !== '' ? 'focused' : ''])
  }, [_cache[42] || (_cache[42] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_towers"
  }, "Units in towers", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_63, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_towers",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $setup.other_details.units_in_towers = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_towers]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_64, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_on_floor !== '' ? 'focused' : ''])
  }, [_cache[43] || (_cache[43] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_on_floor"
  }, "Units on floor", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_on_floor",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $setup.other_details.units_on_floor = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_on_floor]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_66, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_elevators !== '' ? 'focused' : ''])
  }, [_cache[44] || (_cache[44] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_elevators"
  }, "Number of elevators", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_elevators",
    "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
      return $setup.other_details.number_of_elevators = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_elevators]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_68, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_bathrooms !== '' ? 'focused' : ''])
  }, [_cache[45] || (_cache[45] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_bathrooms"
  }, "Number of bathrooms", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_bathrooms",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $setup.other_details.number_of_bathrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_bathrooms]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_72, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "service_elevator",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[18] || (_cache[18] = function ($event) {
      return $setup.other_details.service_elevator = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.service_elevator]]), _cache[46] || (_cache[46] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "service_elevator"
  }, "Service Elevator", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "servent_room",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $setup.other_details.servent_room = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.servent_room]]), _cache[47] || (_cache[47] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "servent_room"
  }, "Servent Room", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_74, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_hot",
    type: "checkbox",
    value: "1",
    "onUpdate:modelValue": _cache[20] || (_cache[20] = function ($event) {
      return $setup.other_details.is_hot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_hot]]), _cache[48] || (_cache[48] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_hot"
  }, "Hot", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_75, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_76, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.four_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[49] || (_cache[49] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "four_wheeler_parking"
  }, "Four wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_77, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "four_wheeler_parking",
    "onUpdate:modelValue": _cache[21] || (_cache[21] = function ($event) {
      return $setup.other_details.four_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.four_wheeler_parking]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_78, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.two_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[50] || (_cache[50] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "two_wheeler_parking"
  }, "Two wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_79, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "two_wheeler_parking",
    "onUpdate:modelValue": _cache[22] || (_cache[22] = function ($event) {
      return $setup.other_details.two_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.two_wheeler_parking]])])], 2 /* CLASS */)]), _cache[52] || (_cache[52] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"priority\"><option value=\"\">Priority</option><option value=\"High\">High</option><option value=\"Medium\">Medium</option><option value=\"Low\">Low</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_80, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_81, [_cache[51] || (_cache[51] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Source", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_source, function (source) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: source.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(source.name), 9 /* TEXT, PROPS */, _hoisted_82);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_83, [_cache[55] || (_cache[55] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Availability Status", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_84, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_85, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Available",
    name: "availability_status",
    id: "available",
    "onUpdate:modelValue": _cache[23] || (_cache[23] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[24] || (_cache[24] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[53] || (_cache[53] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "available"
  }, "Available", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_86, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Under Construction",
    name: "availability_status",
    id: "under_con",
    "onUpdate:modelValue": _cache[25] || (_cache[25] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[26] || (_cache[26] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[54] || (_cache[54] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "under_con"
  }, "Under Construction", -1 /* HOISTED */))])])]), $setup.other_details.availability_status ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_87, [$setup.other_details.availability_status == 'Available' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_88, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.age_of_property, function (age) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_89, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "radio",
      "class": "btn-check",
      value: age,
      name: "age_of_property",
      id: "age-".concat(age),
      "onUpdate:modelValue": _cache[27] || (_cache[27] = function ($event) {
        return $setup.other_details.age_of_property = $event;
      })
    }, null, 8 /* PROPS */, _hoisted_90), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.age_of_property]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "btn btn-outline-primary btn-pill btn-sm py-1",
      "for": "age-".concat(age)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(age), 9 /* TEXT, PROPS */, _hoisted_91)]);
  }), 64 /* STABLE_FRAGMENT */))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $setup.other_details.availability_status == 'Under Construction' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_92, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.available_from !== '' ? 'focused' : ''])
  }, [_cache[56] || (_cache[56] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "available_from"
  }, "Available From", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_93, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "available_from",
    "onUpdate:modelValue": _cache[28] || (_cache[28] = function ($event) {
      return $setup.other_details.available_from = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.available_from]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_94, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_96, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_have_amenities",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[29] || (_cache[29] = function ($event) {
      return $setup.other_details.is_have_amenities = $event;
    }),
    onChange: _cache[30] || (_cache[30] = function ($event) {
      return $setup.other_details.amenities = [];
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_have_amenities]]), _cache[57] || (_cache[57] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_have_amenities"
  }, "Amenities", -1 /* HOISTED */))])])]), $setup.other_details.is_have_amenities ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_97, [_cache[58] || (_cache[58] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Amenities", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_98, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.amenities, function (amenity) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_99, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)(((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("input", {
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return $setup.other_details.amenities[amenity.id] = $event;
      },
      "class": "form-check-input",
      id: "amenity-".concat(amenity.id),
      key: "amenity-".concat(amenity.id),
      value: amenity.id,
      type: "checkbox"
    }, null, 8 /* PROPS */, _hoisted_100)), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.amenities[amenity.id]]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "amenity-".concat(amenity.id)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(amenity.name), 9 /* TEXT, PROPS */, _hoisted_101)]);
  }), 256 /* UNKEYED_FRAGMENT */))])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_102, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_103, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.remark !== '' ? 'focused' : ''])
  }, [_cache[59] || (_cache[59] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "remark"
  }, "Property Remark", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_104, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "remark",
    "onUpdate:modelValue": _cache[31] || (_cache[31] = function ($event) {
      return $setup.other_details.remark = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.remark]])])], 2 /* CLASS */)])])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=template&id=3b35b62b":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=template&id=3b35b62b ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row gy-2"
};
var _hoisted_2 = {
  "class": "col-md-3"
};
var _hoisted_3 = {
  "class": "input-group"
};
var _hoisted_4 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_5 = {
  "class": "fvalue"
};
var _hoisted_6 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_7 = {
  "class": "form-group"
};
var _hoisted_8 = {
  "class": "form-select",
  id: "salable_area_unit"
};
var _hoisted_9 = ["value"];
var _hoisted_10 = {
  "class": "col-md-3"
};
var _hoisted_11 = {
  "class": "input-group"
};
var _hoisted_12 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_13 = {
  "class": "fvalue"
};
var _hoisted_14 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_15 = {
  "class": "form-group"
};
var _hoisted_16 = {
  "class": "form-select",
  id: "ceiling_height_unit"
};
var _hoisted_17 = ["value"];
var _hoisted_18 = {
  "class": "col-md-3"
};
var _hoisted_19 = {
  "class": "input-group"
};
var _hoisted_20 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_21 = {
  "class": "fvalue"
};
var _hoisted_22 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_23 = {
  "class": "form-group"
};
var _hoisted_24 = {
  "class": "form-select",
  id: "opening_width_unit"
};
var _hoisted_25 = ["value"];
var _hoisted_26 = {
  "class": "col-md-3"
};
var _hoisted_27 = {
  "class": "form-check checkbox checkbox-solid-success"
};
var _hoisted_28 = {
  "class": "row gy-2"
};
var _hoisted_29 = {
  "class": "col"
};
var _hoisted_30 = {
  "for": "add_carpet_area",
  "class": "add-input-link fw-bold"
};
var _hoisted_31 = {
  key: 0,
  "for": "add_terrace_carpet_area",
  "class": "add-input-link ms-3 fw-bold"
};
var _hoisted_32 = {
  "class": "row gy-2 mt-1"
};
var _hoisted_33 = {
  "class": "col-md-4"
};
var _hoisted_34 = {
  "class": "input-group"
};
var _hoisted_35 = {
  "class": "form-group col-md-7"
};
var _hoisted_36 = {
  "class": "fvalue"
};
var _hoisted_37 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_38 = {
  "class": "form-group"
};
var _hoisted_39 = {
  "class": "form-select",
  id: "carpet_area_unit"
};
var _hoisted_40 = ["value"];
var _hoisted_41 = {
  "class": "col-md-4"
};
var _hoisted_42 = {
  "class": "input-group"
};
var _hoisted_43 = {
  "class": "form-group col-md-7"
};
var _hoisted_44 = {
  "class": "fvalue"
};
var _hoisted_45 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_46 = {
  "class": "form-group"
};
var _hoisted_47 = {
  "class": "form-select",
  id: "terrace_saleable_area_unit"
};
var _hoisted_48 = ["value"];
var _hoisted_49 = {
  "class": "col-md-4"
};
var _hoisted_50 = {
  "class": "input-group"
};
var _hoisted_51 = {
  "class": "form-group col-md-7"
};
var _hoisted_52 = {
  "class": "fvalue"
};
var _hoisted_53 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_54 = {
  "class": "form-group"
};
var _hoisted_55 = {
  "class": "form-select",
  id: "terrace_carpet_area_unit"
};
var _hoisted_56 = ["value"];
var _hoisted_57 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_58 = {
  "class": "col-12 col-md-2"
};
var _hoisted_59 = {
  "class": "fvalue"
};
var _hoisted_60 = {
  "class": "col-12 col-md-2"
};
var _hoisted_61 = {
  "class": "fvalue"
};
var _hoisted_62 = {
  "class": "col-12 col-md-2"
};
var _hoisted_63 = {
  "class": "fvalue"
};
var _hoisted_64 = {
  key: 0,
  "class": "col-12 col-md-2"
};
var _hoisted_65 = {
  "class": "fvalue"
};
var _hoisted_66 = {
  "class": "col-12 col-md-2"
};
var _hoisted_67 = {
  "class": "fvalue"
};
var _hoisted_68 = {
  "class": "row mt-3"
};
var _hoisted_69 = {
  "class": "row div_checkboxes1"
};
var _hoisted_70 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_71 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_72 = {
  key: 0,
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_73 = {
  "class": "row mt-2"
};
var _hoisted_74 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_75 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_76 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_77 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_78 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_79 = {
  "class": "col-12 col-md-2"
};
var _hoisted_80 = {
  "class": "fvalue"
};
var _hoisted_81 = {
  "class": "col-12 col-md-2"
};
var _hoisted_82 = {
  "class": "fvalue"
};
var _hoisted_83 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_84 = {
  "class": "form-select",
  id: "source"
};
var _hoisted_85 = ["value"];
var _hoisted_86 = {
  "class": "row mt-2"
};
var _hoisted_87 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_88 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_89 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_90 = {
  key: 0,
  "class": "row mt-2"
};
var _hoisted_91 = {
  key: 0,
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_92 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_93 = ["value", "id"];
var _hoisted_94 = ["for"];
var _hoisted_95 = {
  key: 1,
  "class": "col-12 col-md-2"
};
var _hoisted_96 = {
  "class": "fvalue"
};
var _hoisted_97 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_98 = {
  "class": "col-12 col-md-7"
};
var _hoisted_99 = {
  "class": "fvalue"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [_cache[36] || (_cache[36] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Area Size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.saleable_area !== '' ? 'focused' : ''])
  }, [_cache[32] || (_cache[32] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "saleable_area"
  }, "Saleble Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "saleable_area",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.other_details.saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_8, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_9)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.ceiling_height !== '' ? 'focused' : ''])
  }, [_cache[33] || (_cache[33] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "ceiling_height"
  }, "Ceiling Height", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "ceiling_height",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $setup.other_details.ceiling_height = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.ceiling_height]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_16, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_17)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.opening_width !== '' ? 'focused' : ''])
  }, [_cache[34] || (_cache[34] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "opening_width"
  }, "Opening Width", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "opening_width",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.other_details.opening_width = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.opening_width]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_24, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_25)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.props.property_category == 2]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_terrace",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $setup.other_details.is_terrace = $event;
    }),
    onChange: _cache[4] || (_cache[4] = function ($event) {
      return $setup.resetValue(['terrace_saleable_area', 'terrace_saleable_area_unit', 'terrace_carpet_area', 'terrace_carpet_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_terrace]]), _cache[35] || (_cache[35] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_terrace"
  }, "Terrace", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_30, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_carpet_area != 1 ? '+ Add' : '- Remove') + " Carpet Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return $setup.other_details.add_carpet_area = $event;
    }),
    onChange: _cache[6] || (_cache[6] = function ($event) {
      return $setup.resetValue(['carpet_area', 'carpet_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_carpet_area]]), $setup.other_details.is_terrace == 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("label", _hoisted_31, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_terrace_carpet_area != 1 ? '+ Add' : '- Remove') + " Terrace Carpet Area", 1 /* TEXT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_terrace_carpet_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $setup.other_details.add_terrace_carpet_area = $event;
    }),
    onChange: _cache[8] || (_cache[8] = function ($event) {
      return $setup.resetValue(['terrace_carpet_area', 'terrace_carpet_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_terrace_carpet_area]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.carpet_area !== '' ? 'focused' : ''])
  }, [_cache[37] || (_cache[37] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "carpet_area"
  }, "Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "carpet_area",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.other_details.carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_39, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_40)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_carpet_area == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.terrace_saleable_area !== '' ? 'focused' : ''])
  }, [_cache[38] || (_cache[38] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "terrace_saleable_area"
  }, "Terrace Saleable Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "terrace_saleable_area",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return $setup.other_details.terrace_saleable_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.terrace_saleable_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_47, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_48)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.is_terrace == 1]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_51, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.terrace_carpet_area !== '' ? 'focused' : ''])
  }, [_cache[39] || (_cache[39] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "terrace_carpet_area"
  }, "Terrace Carpet Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_52, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "terrace_carpet_area",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.other_details.terrace_carpet_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.terrace_carpet_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_55, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_56)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_terrace_carpet_area == 1 && $setup.other_details.is_terrace == 1]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_project !== '' ? 'focused' : ''])
  }, [_cache[40] || (_cache[40] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_project"
  }, "Units in project", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_project",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $setup.other_details.units_in_project = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_project]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_floor !== '' ? 'focused' : ''])
  }, [_cache[41] || (_cache[41] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_floor"
  }, "Number of floor", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_floor",
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $setup.other_details.number_of_floor = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_floor]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_towers !== '' ? 'focused' : ''])
  }, [_cache[42] || (_cache[42] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_towers"
  }, "Units in towers", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_63, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_towers",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $setup.other_details.units_in_towers = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_towers]])])], 2 /* CLASS */)]), $setup.props.property_category == 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_64, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_on_floor !== '' ? 'focused' : ''])
  }, [_cache[43] || (_cache[43] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_on_floor"
  }, "Units on floor", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_on_floor",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $setup.other_details.units_on_floor = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_on_floor]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_66, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.number_of_elevators !== '' ? 'focused' : ''])
  }, [_cache[44] || (_cache[44] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "number_of_elevators"
  }, "Number of elevators", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "number_of_elevators",
    "onUpdate:modelValue": _cache[16] || (_cache[16] = function ($event) {
      return $setup.other_details.number_of_elevators = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.number_of_elevators]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_68, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "service_elevator",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $setup.other_details.service_elevator = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.service_elevator]]), _cache[45] || (_cache[45] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "service_elevator"
  }, "Service Elevator", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_hot",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[18] || (_cache[18] = function ($event) {
      return $setup.other_details.is_hot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_hot]]), _cache[46] || (_cache[46] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_hot"
  }, "Hot", -1 /* HOISTED */))]), $setup.props.property_category == 2 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_72, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_two_road_corner",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[19] || (_cache[19] = function ($event) {
      return $setup.other_details.two_road_corner = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.two_road_corner]]), _cache[47] || (_cache[47] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_two_road_corner"
  }, "Two Road Corner", -1 /* HOISTED */))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_73, [_cache[51] || (_cache[51] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Washrooms", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_74, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_75, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Private Washrooms",
    name: "washrooms",
    id: "private_washroom",
    "onUpdate:modelValue": _cache[20] || (_cache[20] = function ($event) {
      return $setup.other_details.washrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.washrooms]]), _cache[48] || (_cache[48] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "private_washroom"
  }, "Private Washrooms", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_76, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Public Washrooms",
    name: "washrooms",
    id: "public_washroom",
    "onUpdate:modelValue": _cache[21] || (_cache[21] = function ($event) {
      return $setup.other_details.washrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.washrooms]]), _cache[49] || (_cache[49] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "public_washroom"
  }, "Public Washrooms", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_77, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Not Available",
    name: "washrooms",
    id: "not_available",
    "onUpdate:modelValue": _cache[22] || (_cache[22] = function ($event) {
      return $setup.other_details.washrooms = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.washrooms]]), _cache[50] || (_cache[50] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "not_available"
  }, "Not Available", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_78, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_79, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.four_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[52] || (_cache[52] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "four_wheeler_parking"
  }, "Four wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_80, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "four_wheeler_parking",
    "onUpdate:modelValue": _cache[23] || (_cache[23] = function ($event) {
      return $setup.other_details.four_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.four_wheeler_parking]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_81, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.two_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[53] || (_cache[53] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "two_wheeler_parking"
  }, "Two wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_82, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "two_wheeler_parking",
    "onUpdate:modelValue": _cache[24] || (_cache[24] = function ($event) {
      return $setup.other_details.two_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.two_wheeler_parking]])])], 2 /* CLASS */)]), _cache[55] || (_cache[55] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"priority\"><option value=\"\">Priority</option><option value=\"High\">High</option><option value=\"Medium\">Medium</option><option value=\"Low\">Low</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_83, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_84, [_cache[54] || (_cache[54] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Source", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_source, function (source) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: source.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(source.name), 9 /* TEXT, PROPS */, _hoisted_85);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_86, [_cache[58] || (_cache[58] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Availability Status", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_87, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_88, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Available",
    name: "availability_status",
    id: "available",
    "onUpdate:modelValue": _cache[25] || (_cache[25] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[26] || (_cache[26] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[56] || (_cache[56] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "available"
  }, "Available", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_89, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Under Construction",
    name: "availability_status",
    id: "under_con",
    "onUpdate:modelValue": _cache[27] || (_cache[27] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[28] || (_cache[28] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[57] || (_cache[57] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "under_con"
  }, "Under Construction", -1 /* HOISTED */))])])]), $setup.other_details.availability_status ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_90, [$setup.other_details.availability_status == 'Available' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_91, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.age_of_property, function (age) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_92, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "radio",
      "class": "btn-check",
      value: age,
      name: "age_of_property",
      id: "age-".concat(age),
      "onUpdate:modelValue": _cache[29] || (_cache[29] = function ($event) {
        return $setup.other_details.age_of_property = $event;
      })
    }, null, 8 /* PROPS */, _hoisted_93), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.age_of_property]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "btn btn-outline-primary btn-pill btn-sm py-1",
      "for": "age-".concat(age)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(age), 9 /* TEXT, PROPS */, _hoisted_94)]);
  }), 64 /* STABLE_FRAGMENT */))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $setup.other_details.availability_status == 'Under Construction' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_95, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.available_from !== '' ? 'focused' : ''])
  }, [_cache[59] || (_cache[59] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "available_from"
  }, "Available From", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_96, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "available_from",
    "onUpdate:modelValue": _cache[30] || (_cache[30] = function ($event) {
      return $setup.other_details.available_from = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.available_from]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_97, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_98, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.remark !== '' ? 'focused' : ''])
  }, [_cache[60] || (_cache[60] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "remark"
  }, "Property Remark", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_99, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "remark",
    "onUpdate:modelValue": _cache[31] || (_cache[31] = function ($event) {
      return $setup.other_details.remark = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.remark]])])], 2 /* CLASS */)])])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=template&id=926a4400":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=template&id=926a4400 ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_2 = {
  "class": "row gy-2"
};
var _hoisted_3 = {
  "class": "col"
};
var _hoisted_4 = {
  "for": "add_carpet_plot_area",
  "class": "add-input-link fw-bold"
};
var _hoisted_5 = {
  "class": "col-md-3"
};
var _hoisted_6 = {
  "class": "input-group"
};
var _hoisted_7 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_8 = {
  "class": "fvalue"
};
var _hoisted_9 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_10 = {
  "class": "form-group"
};
var _hoisted_11 = {
  "class": "form-select",
  id: "saleable_plot_area_unit"
};
var _hoisted_12 = ["value"];
var _hoisted_13 = {
  "class": "col-md-3"
};
var _hoisted_14 = {
  "class": "input-group"
};
var _hoisted_15 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_16 = {
  "class": "fvalue"
};
var _hoisted_17 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_18 = {
  "class": "form-group"
};
var _hoisted_19 = {
  "class": "form-select",
  id: "carpet_plot_area_unit"
};
var _hoisted_20 = ["value"];
var _hoisted_21 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_22 = {
  "class": "col-12 col-md-2"
};
var _hoisted_23 = {
  "class": "fvalue"
};
var _hoisted_24 = {
  "class": "row mt-2"
};
var _hoisted_25 = {
  "class": "row div_checkboxes1"
};
var _hoisted_26 = {
  "class": "form-check checkbox checkbox-solid-success mb-0 col-md-2"
};
var _hoisted_27 = {
  "class": "row mt-2"
};
var _hoisted_28 = {
  "class": "col-md-3"
};
var _hoisted_29 = {
  "class": "input-group"
};
var _hoisted_30 = {
  "class": "form-group col-md-7 m-b-20"
};
var _hoisted_31 = {
  "class": "fvalue"
};
var _hoisted_32 = {
  "class": "input-group-append col-md-5"
};
var _hoisted_33 = {
  "class": "form-group"
};
var _hoisted_34 = {
  "class": "form-select",
  id: "road_width_of_front_side_unit"
};
var _hoisted_35 = ["value"];
var _hoisted_36 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_37 = {
  "class": "col-12 col-md-2"
};
var _hoisted_38 = {
  "class": "fvalue"
};
var _hoisted_39 = {
  "class": "col-12 col-md-2"
};
var _hoisted_40 = {
  "class": "fvalue"
};
var _hoisted_41 = {
  "class": "col-md-2 m-b-4 mb-4"
};
var _hoisted_42 = {
  "class": "form-select",
  id: "source"
};
var _hoisted_43 = ["value"];
var _hoisted_44 = {
  "class": "row mt-2"
};
var _hoisted_45 = {
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_46 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_47 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_48 = {
  key: 0,
  "class": "row mt-2 mb-5"
};
var _hoisted_49 = {
  key: 0,
  "class": "m-checkbox-inline custom-radio-ml mt-2 mb-2"
};
var _hoisted_50 = {
  "class": "btn-group bromi-checkbox-btn me-1",
  role: "group",
  "aria-label": "Basic radio toggle button group"
};
var _hoisted_51 = ["value", "id"];
var _hoisted_52 = ["for"];
var _hoisted_53 = {
  key: 1,
  "class": "col-12 col-md-2"
};
var _hoisted_54 = {
  "class": "fvalue"
};
var _hoisted_55 = {
  "class": "row mt-3 mb-5"
};
var _hoisted_56 = {
  "class": "col-12 col-md-2"
};
var _hoisted_57 = {
  "class": "fvalue"
};
var _hoisted_58 = {
  key: 0,
  "class": "col-12 col-md-2"
};
var _hoisted_59 = {
  "class": "row mb-3"
};
var _hoisted_60 = {
  "class": "col-12 col-md-4"
};
var _hoisted_61 = {
  "class": "form-check checkbox checkbox-solid-success mb-0"
};
var _hoisted_62 = ["id", "onUpdate:modelValue"];
var _hoisted_63 = ["for"];
var _hoisted_64 = ["for"];
var _hoisted_65 = {
  "class": "fvalue"
};
var _hoisted_66 = ["id", "onUpdate:modelValue"];
var _hoisted_67 = {
  key: 0,
  "class": "col-12 col-md-2"
};
var _hoisted_68 = ["onClick"];
var _hoisted_69 = {
  "class": "row gy-2 mt-3"
};
var _hoisted_70 = {
  "class": "col-12 col-md-7"
};
var _hoisted_71 = {
  "class": "fvalue"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [_cache[20] || (_cache[20] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Area Size", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($setup.other_details.add_carpet_plot_area != 1 ? '+ Add' : '- Remove') + " Carpet Plot Area", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "checkbox",
    value: "1",
    id: "add_carpet_plot_area",
    "class": "d-none",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $setup.other_details.add_carpet_plot_area = $event;
    }),
    onChange: _cache[1] || (_cache[1] = function ($event) {
      return $setup.resetValue(['carpet_plot_area', 'carpet_plot_area_unit']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.add_carpet_plot_area]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.saleable_plot_area !== '' ? 'focused' : ''])
  }, [_cache[18] || (_cache[18] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "saleable_plot_area"
  }, "Saleble Plot Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "saleable_plot_area",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $setup.other_details.saleable_plot_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.saleable_plot_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_11, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_12)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.carpet_plot_area !== '' ? 'focused' : ''])
  }, [_cache[19] || (_cache[19] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "carpet_plot_area"
  }, "Carpet Plot Area", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "carpet_plot_area",
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $setup.other_details.carpet_plot_area = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.carpet_plot_area]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_19, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [![24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_20)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $setup.other_details.add_carpet_plot_area == 1]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.units_in_project !== '' ? 'focused' : ''])
  }, [_cache[21] || (_cache[21] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "units_in_project"
  }, "Units in project", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "units_in_project",
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $setup.other_details.units_in_project = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.units_in_project]])])], 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input",
    id: "is_hot",
    value: "1",
    type: "checkbox",
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return $setup.other_details.is_hot = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $setup.other_details.is_hot]]), _cache[22] || (_cache[22] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "form-check-label",
    "for": "is_hot"
  }, "Hot", -1 /* HOISTED */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_30, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.road_width_of_front_side !== '' ? 'focused' : ''])
  }, [_cache[23] || (_cache[23] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "road_width_of_front_side"
  }, "Road width of front side", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_31, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "road_width_of_front_side",
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return $setup.other_details.road_width_of_front_side = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.road_width_of_front_side]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_34, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.land_units, function (unit) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [[24, 25].includes(unit.id) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: 0,
      value: unit.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(unit.unit_name), 9 /* TEXT, PROPS */, _hoisted_35)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 64 /* STABLE_FRAGMENT */);
  }), 256 /* UNKEYED_FRAGMENT */))])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.four_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[24] || (_cache[24] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "four_wheeler_parking"
  }, "Four wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "four_wheeler_parking",
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return $setup.other_details.four_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.four_wheeler_parking]])])], 2 /* CLASS */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.two_wheeler_parking !== '' ? 'focused' : ''])
  }, [_cache[25] || (_cache[25] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "two_wheeler_parking"
  }, "Two wheeler parking", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "two_wheeler_parking",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $setup.other_details.two_wheeler_parking = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.two_wheeler_parking]])])], 2 /* CLASS */)]), _cache[27] || (_cache[27] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"col-md-2 m-b-4 mb-4\"><select class=\"form-select\" id=\"priority\"><option value=\"\">Priority</option><option value=\"High\">High</option><option value=\"Medium\">Medium</option><option value=\"Low\">Low</option></select></div>", 1)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", _hoisted_42, [_cache[26] || (_cache[26] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: ""
  }, "Source", -1 /* HOISTED */)), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.props.property_source, function (source) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: source.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(source.name), 9 /* TEXT, PROPS */, _hoisted_43);
  }), 256 /* UNKEYED_FRAGMENT */))])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [_cache[30] || (_cache[30] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Availability Status", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_46, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Available",
    name: "availability_status",
    id: "available",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[10] || (_cache[10] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[28] || (_cache[28] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "available"
  }, "Available", -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_47, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    "class": "btn-check",
    value: "Under Construction",
    name: "availability_status",
    id: "under_con",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $setup.other_details.availability_status = $event;
    }),
    onChange: _cache[12] || (_cache[12] = function ($event) {
      return $setup.resetValue(['age_of_property', 'available_from']);
    })
  }, null, 544 /* NEED_HYDRATION, NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.availability_status]]), _cache[29] || (_cache[29] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "class": "btn btn-outline-primary btn-pill btn-sm py-1",
    "for": "under_con"
  }, "Under Construction", -1 /* HOISTED */))])])]), $setup.other_details.availability_status ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_48, [$setup.other_details.availability_status == 'Available' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_49, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.age_of_property, function (age) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      type: "radio",
      "class": "btn-check",
      value: age,
      name: "age_of_property",
      id: "age-".concat(age),
      "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
        return $setup.other_details.age_of_property = $event;
      })
    }, null, 8 /* PROPS */, _hoisted_51), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $setup.other_details.age_of_property]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "btn btn-outline-primary btn-pill btn-sm py-1",
      "for": "age-".concat(age)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(age), 9 /* TEXT, PROPS */, _hoisted_52)]);
  }), 64 /* STABLE_FRAGMENT */))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $setup.other_details.availability_status == 'Under Construction' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_53, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.available_from !== '' ? 'focused' : ''])
  }, [_cache[31] || (_cache[31] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "available_from"
  }, "Available From", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "available_from",
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $setup.other_details.available_from = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.available_from]])])], 2 /* CLASS */)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_55, [_cache[33] || (_cache[33] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", {
    "class": "mb-2"
  }, "Other Details", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.temp_input_field !== '' ? 'focused' : ''])
  }, [_cache[32] || (_cache[32] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "field_name"
  }, "Field Name", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "field_name",
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $setup.other_details.temp_input_field = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.temp_input_field]])])], 2 /* CLASS */)]), $setup.other_details.temp_input_field !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_58, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-primary",
    type: "button",
    onClick: _cache[16] || (_cache[16] = function ($event) {
      return $setup.addOtherField();
    })
  }, "Add Field")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.other_details.other_storage_industrial_detail, function (other_detail, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-check-input",
      id: "other_detail_".concat(other_detail.name),
      value: "1",
      type: "checkbox",
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return other_detail.is_active = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_62), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, other_detail.is_active]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "class": "form-check-label",
      "for": "other_detail_".concat(other_detail.name)
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(other_detail.name), 9 /* TEXT, PROPS */, _hoisted_63)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["col-12", other_detail.exist ? 'col-md-7' : 'col-md-5'])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", other_detail.value !== '' ? 'focused' : ''])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
      "for": "other_detail_".concat(other_detail.name, "_value")
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(other_detail.name), 9 /* TEXT, PROPS */, _hoisted_64), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
      "class": "form-control",
      type: "text",
      value: "",
      id: "other_detail_".concat(other_detail.name, "_value"),
      "onUpdate:modelValue": function onUpdateModelValue($event) {
        return other_detail.value = $event;
      }
    }, null, 8 /* PROPS */, _hoisted_66), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, other_detail.value]])])], 2 /* CLASS */)], 2 /* CLASS */), !other_detail.exist ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_67, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-danger",
      type: "button",
      onClick: function onClick($event) {
        return $setup.removeOtherDetail(index);
      }
    }, "-", 8 /* PROPS */, _hoisted_68)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]);
  }), 256 /* UNKEYED_FRAGMENT */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_69, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["fname", $setup.other_details.remark !== '' ? 'focused' : ''])
  }, [_cache[34] || (_cache[34] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "remark"
  }, "Property Remark", -1 /* HOISTED */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": "form-control",
    type: "text",
    value: "",
    id: "remark",
    "onUpdate:modelValue": _cache[17] || (_cache[17] = function ($event) {
      return $setup.other_details.remark = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $setup.other_details.remark]])])], 2 /* CLASS */)])])], 64 /* STABLE_FRAGMENT */);
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

/***/ "./resources/js/Components/Property/EditForm.vue":
/*!*******************************************************!*\
  !*** ./resources/js/Components/Property/EditForm.vue ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _EditForm_vue_vue_type_template_id_0c36e366__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EditForm.vue?vue&type=template&id=0c36e366 */ "./resources/js/Components/Property/EditForm.vue?vue&type=template&id=0c36e366");
/* harmony import */ var _EditForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EditForm.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/EditForm.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_EditForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_EditForm_vue_vue_type_template_id_0c36e366__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/EditForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/LandForm.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/LandForm.vue ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _LandForm_vue_vue_type_template_id_2c688157__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LandForm.vue?vue&type=template&id=2c688157 */ "./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=template&id=2c688157");
/* harmony import */ var _LandForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LandForm.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_LandForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_LandForm_vue_vue_type_template_id_2c688157__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/UpdateForms/LandForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/PenthouseForm.vue":
/*!************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/PenthouseForm.vue ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _PenthouseForm_vue_vue_type_template_id_562aa311__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PenthouseForm.vue?vue&type=template&id=562aa311 */ "./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=template&id=562aa311");
/* harmony import */ var _PenthouseForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PenthouseForm.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_PenthouseForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_PenthouseForm_vue_vue_type_template_id_562aa311__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/UpdateForms/PenthouseForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/PlotForm.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/PlotForm.vue ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _PlotForm_vue_vue_type_template_id_2cd9b366__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PlotForm.vue?vue&type=template&id=2cd9b366 */ "./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=template&id=2cd9b366");
/* harmony import */ var _PlotForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PlotForm.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_PlotForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_PlotForm_vue_vue_type_template_id_2cd9b366__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/UpdateForms/PlotForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/VilaBanglow.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/VilaBanglow.vue ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _VilaBanglow_vue_vue_type_template_id_72a2f988__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./VilaBanglow.vue?vue&type=template&id=72a2f988 */ "./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=template&id=72a2f988");
/* harmony import */ var _VilaBanglow_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./VilaBanglow.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_VilaBanglow_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_VilaBanglow_vue_vue_type_template_id_72a2f988__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/UpdateForms/VilaBanglow.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/flatForm.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/flatForm.vue ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _flatForm_vue_vue_type_template_id_36d32cc5__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./flatForm.vue?vue&type=template&id=36d32cc5 */ "./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=template&id=36d32cc5");
/* harmony import */ var _flatForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./flatForm.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_flatForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_flatForm_vue_vue_type_template_id_36d32cc5__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/UpdateForms/flatForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/officeRetailForm.vue":
/*!***************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/officeRetailForm.vue ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _officeRetailForm_vue_vue_type_template_id_3b35b62b__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./officeRetailForm.vue?vue&type=template&id=3b35b62b */ "./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=template&id=3b35b62b");
/* harmony import */ var _officeRetailForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./officeRetailForm.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_officeRetailForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_officeRetailForm_vue_vue_type_template_id_3b35b62b__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/UpdateForms/officeRetailForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue":
/*!********************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _storageIndustrialForm_vue_vue_type_template_id_926a4400__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./storageIndustrialForm.vue?vue&type=template&id=926a4400 */ "./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=template&id=926a4400");
/* harmony import */ var _storageIndustrialForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./storageIndustrialForm.vue?vue&type=script&setup=true&lang=js */ "./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_storageIndustrialForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_storageIndustrialForm_vue_vue_type_template_id_926a4400__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Components/Property/EditForm.vue?vue&type=script&setup=true&lang=js":
/*!******************************************************************************************!*\
  !*** ./resources/js/Components/Property/EditForm.vue?vue&type=script&setup=true&lang=js ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./EditForm.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/EditForm.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=script&setup=true&lang=js":
/*!******************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=script&setup=true&lang=js ***!
  \******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./LandForm.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=script&setup=true&lang=js":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=script&setup=true&lang=js ***!
  \***********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_PenthouseForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_PenthouseForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./PenthouseForm.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=script&setup=true&lang=js":
/*!******************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=script&setup=true&lang=js ***!
  \******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_PlotForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_PlotForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./PlotForm.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=script&setup=true&lang=js":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=script&setup=true&lang=js ***!
  \*********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_VilaBanglow_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_VilaBanglow_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./VilaBanglow.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=script&setup=true&lang=js":
/*!******************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=script&setup=true&lang=js ***!
  \******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_flatForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_flatForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./flatForm.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=script&setup=true&lang=js":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=script&setup=true&lang=js ***!
  \**************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_officeRetailForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_officeRetailForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./officeRetailForm.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=script&setup=true&lang=js":
/*!*******************************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=script&setup=true&lang=js ***!
  \*******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_storageIndustrialForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_storageIndustrialForm_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./storageIndustrialForm.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/Components/Property/EditForm.vue?vue&type=template&id=0c36e366":
/*!*************************************************************************************!*\
  !*** ./resources/js/Components/Property/EditForm.vue?vue&type=template&id=0c36e366 ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditForm_vue_vue_type_template_id_0c36e366__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditForm_vue_vue_type_template_id_0c36e366__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./EditForm.vue?vue&type=template&id=0c36e366 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/EditForm.vue?vue&type=template&id=0c36e366");


/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=template&id=2c688157":
/*!*************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=template&id=2c688157 ***!
  \*************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandForm_vue_vue_type_template_id_2c688157__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandForm_vue_vue_type_template_id_2c688157__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./LandForm.vue?vue&type=template&id=2c688157 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/LandForm.vue?vue&type=template&id=2c688157");


/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=template&id=562aa311":
/*!******************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=template&id=562aa311 ***!
  \******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_PenthouseForm_vue_vue_type_template_id_562aa311__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_PenthouseForm_vue_vue_type_template_id_562aa311__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./PenthouseForm.vue?vue&type=template&id=562aa311 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PenthouseForm.vue?vue&type=template&id=562aa311");


/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=template&id=2cd9b366":
/*!*************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=template&id=2cd9b366 ***!
  \*************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_PlotForm_vue_vue_type_template_id_2cd9b366__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_PlotForm_vue_vue_type_template_id_2cd9b366__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./PlotForm.vue?vue&type=template&id=2cd9b366 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/PlotForm.vue?vue&type=template&id=2cd9b366");


/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=template&id=72a2f988":
/*!****************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=template&id=72a2f988 ***!
  \****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_VilaBanglow_vue_vue_type_template_id_72a2f988__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_VilaBanglow_vue_vue_type_template_id_72a2f988__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./VilaBanglow.vue?vue&type=template&id=72a2f988 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/VilaBanglow.vue?vue&type=template&id=72a2f988");


/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=template&id=36d32cc5":
/*!*************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=template&id=36d32cc5 ***!
  \*************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_flatForm_vue_vue_type_template_id_36d32cc5__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_flatForm_vue_vue_type_template_id_36d32cc5__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./flatForm.vue?vue&type=template&id=36d32cc5 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/flatForm.vue?vue&type=template&id=36d32cc5");


/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=template&id=3b35b62b":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=template&id=3b35b62b ***!
  \*********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_officeRetailForm_vue_vue_type_template_id_3b35b62b__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_officeRetailForm_vue_vue_type_template_id_3b35b62b__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./officeRetailForm.vue?vue&type=template&id=3b35b62b */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/officeRetailForm.vue?vue&type=template&id=3b35b62b");


/***/ }),

/***/ "./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=template&id=926a4400":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=template&id=926a4400 ***!
  \**************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_storageIndustrialForm_vue_vue_type_template_id_926a4400__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_storageIndustrialForm_vue_vue_type_template_id_926a4400__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./storageIndustrialForm.vue?vue&type=template&id=926a4400 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Components/Property/UpdateForms/storageIndustrialForm.vue?vue&type=template&id=926a4400");


/***/ })

}]);