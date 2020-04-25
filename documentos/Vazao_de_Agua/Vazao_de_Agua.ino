#include <ESP8266WiFi.h>

#ifndef STASSID
#define STASSID "Clevinho"                  // Nome da rede sem fio.
#define STAPSK  "30794489"                  // Senha da rede sem fio.
#endif

const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "cmanager.com.br";       // Nome do site ou IP.
const uint16_t port = 80;                   // Porta usada no site.

#define PINO_PULSOS D2                      // Definição da porta serial do NodeMCU GPIO 4 = D2.

volatile long contadorPulso = 0;            // Contador de pulso, se inicializa em 0.
float FatorCalibracao = 5.5;                // Fator de calibração do sensor. De acordo com a fabricante, é 5.
float quocienteVazao;                       // Quociente de vazão, será usado para calcular os valores em litros, e cúbicos.
unsigned int fluxoMililitros;               // Vazão em mililitros.
unsigned long totalMililitros;              // Vazão total em mililitros.
float totalLitros;                          // Vazão total em litros.
float totalCubico;                          // Vazão total em métros cúbicos.
unsigned long tempo;                        // Tempo, usado para limitação de código em milisegundos.
unsigned long tempoAnterior = 0;            // Armazena o último momento que o script GET foi executado.
const long periodo = 3600000;               // Período em milisegundos para que ocorra a chamada da requisição GET (atualmente: 1 horas).

void ICACHE_RAM_ATTR contarPulsos()
{
  contadorPulso++;                          // Método de incremento no contador de pulsos.
}

void setup() {
 
  contadorPulso   = 0;                                      // Todas as variáveis definidas anteriormente iniciam com 0 no método Start.
  quocienteVazao  = 0.0;
  fluxoMililitros = 0;
  totalMililitros = 0;
  tempo           = 0;

  Serial.begin(9600);                                       // Serial de inicialização do NodeMCU.
 
  pinMode(PINO_PULSOS, INPUT);                              //Indica a entrada de dados do pino "Pulsos".
  attachInterrupt(PINO_PULSOS, contarPulsos, FALLING);      // Script de interrupção do contador.

  // Inicialização da conexão Wi-FI.

  Serial.print("Conectando ao Wi-FI: ");
  Serial.print(ssid);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("O Wi-FI foi conectado com sucesso.");
  Serial.print("Endereço de IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {

  unsigned long tempoAtual = millis();              // Iniciando o tempo atual em milisegundos.
  
  if (tempoAtual - tempoAnterior >= periodo) {      // Se o tempo atual (menos) tempo anterior for igual ao período definido...
    
    inserirGET();                                   // Executa a requisição GET para inserção das informações ao banco de dados.
    tempoAnterior = tempoAtual;                     // Passa o valor de tempo anterior para tempo atual, no intuito de zerá-lo.
    contadorPulso   = 0;                            // Zera todas as demais contagens que foram realizadas.
    quocienteVazao  = 0.0;
    fluxoMililitros = 0;
    totalMililitros = 0;
    tempo           = 0;
    
  } else {                                          // Caso contrário...
    executarSensor();                               // Continua medindo a vazão de águae apresentando o resultado na tela.
  }
}

void executarSensor(){                                                                    // Método que capta a vazão da água.
  
  if((millis() - tempo) > 1000){                                                          // Se o tempo for mairo que 1 segundo...
    detachInterrupt(PINO_PULSOS);                                                         // Desativa a interrupção do pino.
    quocienteVazao = ((1000.0 / (millis() - tempo)) * contadorPulso) / FatorCalibracao;   // Cálculo do quociente de vazão da água.
    tempo = millis();
    fluxoMililitros = (quocienteVazao / 60) * 1000;                                       // Cálculo do fluxo de mililitros.
    totalMililitros += fluxoMililitros;                                                   // Total de mililitros
    totalLitros = totalMililitros * 0.001;                                                // Conversão de mililitros para litros.
    totalCubico = totalLitros / 1000;                                                     // Conversão de litros para métros cúbicos.
    Serial.print("Quantidade em (L): ");
    Serial.print(totalLitros);
    Serial.print(" L/Min");
    Serial.print(" ---------> ");  
    Serial.print("Quantidade em (m³): ");
    Serial.print(totalCubico);
    
    Serial.println(" m³");
   
    contadorPulso = 0;
    attachInterrupt(PINO_PULSOS, contarPulsos, FALLING);
  }
}

void inserirGET(){
  
  Serial.println("Efetuando conexão com o HOST: ");
  Serial.print(host);
  Serial.print(':');
  Serial.println(port);

  // Início da tentativa de inicialização do HTTP.
  WiFiClient client;
  
  if (!client.connect(host, port)) {
    Serial.println("Falha na conexão com o HOST. Por favor, verifique se os dados preenchidos estão de acordo com o seu site.");
    delay(2000);
    return;
  }

  String url = "/controllers/consumocontroller.php?";         // Definição do Script que irá realizar a inclusão das informações no Banco de Dados.
         url += "vazaoagua=";                                 // Prineiro GET.
         url += totalLitros;                                  // Valor em litros (L).
         url += "&condominio=13.457.853/0001-07";             // Segundo GET com valor único do CNPJ condominio.

  Serial.print("Solicitando URL: ");
  Serial.println(url);

  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
              "host: " + host + "\r\n" +
              "connection: close\r\n\r\n");

  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Tempo limite de execução atingido!");
      client.stop();
      delay(20000);
      return;
    }
  }
  
  while (client.available()) {
    String line = client.readStringUntil('\r');
    
    if(line.indexOf("sucesso") != -1){                        // Se receber a informação de que o Script foi executado com sucesso...
      Serial.println("Executado com sucesso.");               // Exibe esta mensagem.
    }else if(line.indexOf("erro") != -1){                     // Se receber a informação de que o Script ficou com erro...
      Serial.println("Falha na execução do script.");         // Exibe esta mensagem.
    }
  }

  Serial.println("Conexão fechada.");                         // Fecha a conexão com o script.
  Serial.println();
  
  delay(1000);                                                // Congela a aplicação por 1 segundo e volta a iniciar as requisições do loop.
}
