var cardForm;
var mercado_pago_submit = false;
cardFormMounted = false;

if (document.getElementById("mp-amount")) {
  var amount = document.getElementById("mp-amount").value;
}

var form = document.querySelector("form[name=checkout]");
var formId = "checkout";
if (form) {
  form.id = formId;
} else {
  formId = "order_review";
}

function mercadoPagoFormHandler() {
  if (mercado_pago_submit) {
    mercado_pago_submit = false;
    return true;
  }

  if (jQuery("#mp_checkout_type").val() === "wallet_button") {
    return true;
  }

  jQuery("#mp_checkout_type").val("custom");

  if (CheckoutPage.validateInputsCreateToken()) {
    return createToken();
  }

  return false;
}

function createToken() {
  cardForm
    .createCardToken()
    .then((cardToken) => {
      if (cardToken.token) {
        document.querySelector("#cardTokenId").value = cardToken.token;
        mercado_pago_submit = true;
        jQuery("form.checkout, form#order_review").submit();
      } else {
        throw new Error("cardToken is empty");
      }
    })
    .catch((error) => {
      console.log("Token creation error: ", error);
    });
  return false;
}

function init_cardForm() {
  var mp = new MercadoPago(wc_mercadopago_params.public_key);

  cardForm = mp.cardForm({
    amount: amount,
    iframe: true,
    form: {
      id: formId,
      cardNumber: {
        id: "form-checkout__cardNumber-container",
        placeholder: "0000 0000 0000 0000",
        style: {
          "font-size": "16px",
          height: "40px",
          padding: "14px",
        },
      },
      cardholderName: {
        id: "form-checkout__cardholderName",
        placeholder: "Ex.: María López",
      },
      cardExpirationDate: {
        id: "form-checkout__cardExpirationDate-container",
        placeholder: wc_mercadopago_params.placeholders["cardExpirationDate"],
        mode: "short",
        style: {
          "font-size": "16px",
          height: "40px",
          padding: "14px",
        },
      },
      securityCode: {
        id: "form-checkout__securityCode-container",
        placeholder: "123",
        style: {
          "font-size": "16px",
          height: "40px",
          padding: "14px",
        },
      },
      identificationType: {
        id: "form-checkout__identificationType",
      },
      identificationNumber: {
        id: "form-checkout__identificationNumber",
      },
      issuer: {
        id: "form-checkout__issuer",
        placeholder: wc_mercadopago_params.placeholders["issuer"],
      },
      installments: {
        id: "form-checkout__installments",
        placeholder: wc_mercadopago_params.placeholders["installments"],
      },
    },
    callbacks: {
      onFormMounted: function (error) {
        cardFormMounted = true;
        if (error)
          return console.log(
            "Callback to handle the error: creating the CardForm",
            error
          );
      },
      onFormUnmounted: function (error) {
        cardFormMounted = false;
        if (error)
          return console.log(
            "Callback to handle the error: unmounting the CardForm",
            error
          );
      },
      onInstallmentsReceived: (error, installments) => {
        if (error) {
          return console.warn("Installments handling error: ", error);
        }
        CheckoutPage.setChangeEventOnInstallments(
          CheckoutPage.getCountry(),
          installments
        );
      },
      onCardTokenReceived: (error) => {
        if (error) {
          return console.warn("Token handling error: ", error);
        }
      },
      onPaymentMethodsReceived: (error, paymentMethods) => {
        try {
          if (paymentMethods) {
            CheckoutPage.setValue("paymentMethodId", paymentMethods[0].id);
            CheckoutPage.setCvvHint(
              paymentMethods[0].settings[0].security_code
            );
            CheckoutPage.changeCvvPlaceHolder(
              paymentMethods[0].settings[0].security_code.length
            );
            CheckoutPage.clearInputs();
            CheckoutPage.setDisplayOfInputHelper("mp-card-number", "none");
            CheckoutPage.setImageCard(paymentMethods[0].thumbnail);
            CheckoutPage.handleInstallments(paymentMethods[0].payment_type_id);
            CheckoutPage.loadAdditionalInfo(
              paymentMethods[0].additional_info_needed
            );
            CheckoutPage.additionalInfoHandler(additionalInfoNeeded);
          } else {
            CheckoutPage.setDisplayOfInputHelper("mp-card-number", "flex");
          }
        } catch (error) {
          CheckoutPage.setDisplayOfInputHelper("mp-card-number", "flex");
        }
      },
      onError: function (errors) {
        errors.forEach((error) => {
          removeBlockOverlay();

          if (error.message.includes("cardNumber")) {
            return CheckoutPage.setDisplayOfInputHelper(
              "mp-card-number",
              "flex"
            );
          } else if (error.message.includes("cardholderName")) {
            return CheckoutPage.setDisplayOfInputHelper(
              "mp-card-holder-name",
              "flex"
            );
          } else if (
            error.message.includes("expirationMonth") ||
            error.message.includes("expirationYear")
          ) {
            return CheckoutPage.setDisplayOfInputHelper(
              "mp-expiration-date",
              "flex"
            );
          } else if (error.message.includes("securityCode")) {
            return CheckoutPage.setDisplayOfInputHelper(
              "mp-security-code",
              "flex"
            );
          } else if (error.message.includes("identificationNumber")) {
            return CheckoutPage.setDisplayOfInputHelper(
              "mp-doc-number",
              "flex"
            );
          } else {
            return console.log("Unknown error: " + error);
          }
        });
      },
      onSubmit: function (event) {
        event.preventDefault();
      },
      onValidityChange: function (error, field) {
        if (error) {
          let helper_message = CheckoutPage.getHelperMessage(field);
          let message =
            wc_mercadopago_params.input_helper_message[field][error[0].code];

          if (message) {
            helper_message.innerHTML = message;
          } else {
            helper_message.innerHTML =
              wc_mercadopago_params.input_helper_message[field][
                "invalid_length"
              ];
          }

          if (field == "cardNumber") {
            CheckoutPage.setBackground(
              "fcCardholderNameContainer",
              "no-repeat #fff"
            );
            CheckoutPage.removeAdditionFields();
          }
          return CheckoutPage.setDisplayOfInputHelper(
            CheckoutPage.inputHelperName(field),
            "flex"
          );
        }
        return CheckoutPage.setDisplayOfInputHelper(
          CheckoutPage.inputHelperName(field),
          "none"
        );
      },
    },
  });
}

/**
 * Remove Block Overlay from Order Review page
 */
function removeBlockOverlay() {
  if (jQuery("form#order_review").length > 0) {
    jQuery(".blockOverlay").css("display", "none");
  }
}

/**
 * Manage mount and unmount the Cardform Instance
 */
function cardFormLoad() {
  if (
    document.getElementById("payment_method_woo-mercado-pago-custom").checked
  ) {
    setTimeout(() => {
      if (!cardFormMounted) init_cardForm();
    }, 1000);
  } else {
    if (cardFormMounted) {
      cardForm.unmount();
    }
  }
}

jQuery("form.checkout").on(
  "checkout_place_order_woo-mercado-pago-custom",
  function () {
    return mercadoPagoFormHandler();
  }
);

jQuery("body").on("payment_method_selected", function () {
  cardFormLoad();
});

// If payment fail, retry on next checkout page
jQuery("form#order_review").submit(function () {
  if (
    document.getElementById("payment_method_woo-mercado-pago-custom").checked
  ) {
    return mercadoPagoFormHandler();
  } else {
    cardForm.unmount();
  }
});
