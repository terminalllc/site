const Ziggy = {"url":"http:\/\/cars.loc","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"livewire.update":{"uri":"livewire\/update","methods":["POST"]},"livewire.upload-file":{"uri":"livewire\/upload-file","methods":["POST"]},"livewire.preview-file":{"uri":"livewire\/preview-file\/{filename}","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"uk.home":{"methods":["GET","HEAD"]},"en.home":{"uri":"\/en","methods":["GET","HEAD"]},"uk.proposal":{"uri":"proposal","methods":["GET","HEAD"]},"en.proposal":{"uri":"en\/proposal","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"login.store":{"uri":"login","methods":["POST"]},"logout":{"uri":"admin\/logout","methods":["DELETE"]},"users.index":{"uri":"admin\/users","methods":["GET","HEAD"]},"users.create":{"uri":"admin\/users\/create","methods":["GET","HEAD"]},"users.store":{"uri":"admin\/users","methods":["POST"]},"users.show":{"uri":"admin\/users\/{user}","methods":["GET","HEAD"]},"users.edit":{"uri":"admin\/users\/{user}\/edit","methods":["GET","HEAD"],"bindings":{"user":"id"}},"users.update":{"uri":"admin\/users\/{user}","methods":["PUT","PATCH"],"bindings":{"user":"id"}},"users.destroy":{"uri":"admin\/users\/{user}","methods":["DELETE"],"bindings":{"user":"id"}},"cars.changeStatusPayment":{"uri":"admin\/cars\/payment\/{car}","methods":["PUT"],"bindings":{"car":"id"}},"cars.index":{"uri":"admin\/cars","methods":["GET","HEAD"]},"cars.create":{"uri":"admin\/cars\/create","methods":["GET","HEAD"]},"cars.store":{"uri":"admin\/cars","methods":["POST"]},"cars.show":{"uri":"admin\/cars\/{car}","methods":["GET","HEAD"]},"cars.edit":{"uri":"admin\/cars\/{car}\/edit","methods":["GET","HEAD"],"bindings":{"car":"id"}},"cars.update":{"uri":"admin\/cars\/{car}","methods":["PUT","PATCH"],"bindings":{"car":"id"}},"cars.destroy":{"uri":"admin\/cars\/{car}","methods":["DELETE"],"bindings":{"car":"id"}},"clients.index":{"uri":"admin\/clients","methods":["GET","HEAD"]},"clients.create":{"uri":"admin\/clients\/create","methods":["GET","HEAD"]},"clients.store":{"uri":"admin\/clients","methods":["POST"]},"clients.show":{"uri":"admin\/clients\/{client}","methods":["GET","HEAD"]},"clients.edit":{"uri":"admin\/clients\/{client}\/edit","methods":["GET","HEAD"],"bindings":{"client":"id"}},"clients.update":{"uri":"admin\/clients\/{client}","methods":["PUT","PATCH"],"bindings":{"client":"id"}},"clients.destroy":{"uri":"admin\/clients\/{client}","methods":["DELETE"],"bindings":{"client":"id"}},"calculations.index":{"uri":"admin\/calculations","methods":["GET","HEAD"]},"calculations.create":{"uri":"admin\/calculations\/create","methods":["GET","HEAD"]},"calculations.store":{"uri":"admin\/calculations","methods":["POST"]},"calculations.show":{"uri":"admin\/calculations\/{calculation}","methods":["GET","HEAD"]},"calculations.edit":{"uri":"admin\/calculations\/{calculation}\/edit","methods":["GET","HEAD"],"bindings":{"calculation":"id"}},"calculations.update":{"uri":"admin\/calculations\/{calculation}","methods":["PUT","PATCH"],"bindings":{"calculation":"id"}},"calculations.destroy":{"uri":"admin\/calculations\/{calculation}","methods":["DELETE"],"bindings":{"calculation":"id"}},"languages.index":{"uri":"admin\/languages","methods":["GET","HEAD"]},"languages.create":{"uri":"admin\/languages\/create","methods":["GET","HEAD"]},"languages.store":{"uri":"admin\/languages","methods":["POST"]},"languages.show":{"uri":"admin\/languages\/{language}","methods":["GET","HEAD"]},"languages.edit":{"uri":"admin\/languages\/{language}\/edit","methods":["GET","HEAD"],"bindings":{"language":"id"}},"languages.update":{"uri":"admin\/languages\/{language}","methods":["PUT","PATCH"],"bindings":{"language":"id"}},"languages.destroy":{"uri":"admin\/languages\/{language}","methods":["DELETE"],"bindings":{"language":"id"}},"translations.index":{"uri":"admin\/translations","methods":["GET","HEAD"]},"translations.create":{"uri":"admin\/translations\/create","methods":["GET","HEAD"]},"translations.store":{"uri":"admin\/translations","methods":["POST"]},"translations.show":{"uri":"admin\/translations\/{translation}","methods":["GET","HEAD"]},"translations.edit":{"uri":"admin\/translations\/{translation}\/edit","methods":["GET","HEAD"],"bindings":{"translation":"id"}},"translations.update":{"uri":"admin\/translations\/{translation}","methods":["PUT","PATCH"],"bindings":{"translation":"id"}},"translations.destroy":{"uri":"admin\/translations\/{translation}","methods":["DELETE"],"bindings":{"translation":"id"}},"setting.edit":{"uri":"admin\/settings\/{setting}\/edit","methods":["GET","HEAD"],"bindings":{"setting":"id"}},"setting.update":{"uri":"admin\/settings\/{setting}","methods":["PUT"],"bindings":{"setting":"id"}},"files.uploadImage":{"uri":"admin\/fm\/upload-image","methods":["POST"]},"files.uploadVideo":{"uri":"admin\/fm\/upload-video","methods":["POST"]},"files.uploadZip":{"uri":"admin\/fm\/upload-zip","methods":["POST"]},"files.unZip":{"uri":"admin\/fm\/unzip","methods":["POST"]},"files.check":{"uri":"admin\/fm\/check","methods":["GET","HEAD"]},"files.optimize":{"uri":"admin\/fm\/optimize","methods":["POST"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
