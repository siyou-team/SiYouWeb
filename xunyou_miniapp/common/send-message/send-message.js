var app=getApp();Component({properties:{MessageType:Number||3,TplKey:String||"",TplData:Array||"",PageUrl:String||""},data:{},methods:{formSubmit:function(e){var t={FormId:e.detail.formId,MessageType:this.data.MessageType,TplKey:this.data.TplKey,PageUrl:this.data.PageUrl,TplData:this.data.TplData};app.SendMessage(t)}}});