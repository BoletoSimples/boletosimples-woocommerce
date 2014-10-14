# Boleto Simples WooCommerce #
**Contributors:** claudiosanches, kivanio  
**Tags:** checkout, billet, boleto, boletosimples  
**Requires at least:** 3.5  
**Tested up to:** 3.9
**Stable tag:** 1.0.1  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

Start getting money by bank billet in your checking account using Boleto Simples

## Description ##

### Description (en): ###

Start getting money by bank billet in your checking account using **[Boleto Simples](http://boletosimples.com.br/)**.

### Descrição (pt_BR): ###

Comece a receber dinheiro por boleto bancário direto na sua conta corrente usando o **[Boleto Simples](http://boletosimples.com.br/)**. Sem limites e sem taxa por boleto.

### Como Funciona o Boleto Bancário ###

[youtube http://www.youtube.com/watch?v=XhCMJ6CpD4M]

O Boleto Bancário é uma forma de pagamento exclusiva do Brasil. Qualquer pessoa física ou jurídica pode cobrar através de boletos bancários. Basta ter uma conta bancária e contratar uma carteira de cobrança junto ao banco. Aprenda mais como funciona, o que é Cedente, Sacado e o que você precisa para começar a cobrar seus clientes por Boleto Bancário.

### Integração ###

A integração é completa para vender por boleto e ainda conta com sistema de retorno que avisa quando o boleto é pago, atualizando o status do seu pedido para *processando*.

### Instalação ###

Instalar é bem simples, basta seguir o nosso [guia de instalação](http://wordpress.org/extend/plugins/boletosimples-woocommerce/installation/).

### Compatibilidade ###

Compatível com as versões 2.0.x e 2.1.x do WooCommerce.

### Dúvidas? ###

Você pode esclarecer suas dúvidas usando:

* A nossa sessão de [FAQ](http://wordpress.org/extend/plugins/boletosimples-woocommerce/faq/).
* Criando um tópico no [fórum do GitHub](https://github.com/BoletoSimples/boletosimples-woocommerce/issues).
* Criando um tópico no [fórum de ajuda do WordPress](http://wordpress.org/support/plugin/boletosimples-woocommerce) (apenas em inglês).

### Coloborar ###

Você pode contribuir com código-fonte em nossa página no [GitHub](https://github.com/BoletoSimples/boletosimples-woocommerce).

## Installation ##

### Instalação do plugin ###

* Faça upload dos arquivos do plugin para a sua pasta de plugins ou faça a instalação usando o instalador do WordPress em `Plugins > Adicionar Novo`;
* Ative o plugin.

### Configuração do Boleto Simples ###

1. Crie uma conta no [Boleto Simples](http://boletosimples.com.br/);
2. Com a conta é possível gerar um Token em [Boleto Simples - API](https://boletosimples.com.br/conta/api);
3. E configure a **URL para notificação** como por exemplo `http://seusite.com.br/?wc-api=WC_BoletoSimples_Gateway`;
4. Pronto, conta configurada.

### Configuração do plugin ###

1. Vá até `WooCommerce > Configurações > Finalizar compra > Boleto Simples`;
2. Habilite o **Boleto Simples** e preencha como preferir as opções de *Título* de *Descrição*;
3. Digite o token gerado na sua conta do **Boleto Simples**;
5. Salve as configurações;
6. Vá até `WooCommerce > Configurações > Produtos > Inventário`;
7. Deixe em branco a opção **Manter estoque (minutos)** (isso evita problemas com contas canceladas antes do cliente pagar o boleto).
8. Salve novamente as configurações;
9. Tudo pronto para receber pagamentos via boleto bancário usando o **Boleto Simples**.

### Configuração do plugin para CPF/CNPJ ###

1. Instale e ative o plugin https://wordpress.org/plugins/woocommerce-extra-checkout-fields-for-brazil/
2. Vá até `WooCommerce > Campos do Checkout`;
3. Escolha 'CPF e CNPJ' em 'Exibir Tipo de Pessoa'
4. Marque a opção 'Caso esteja marcado os campos de Pessoa Física e Pessoa Jurídica serão obrigatórios apenas no Brasil.'
5. Deixe as opções de validação de e-mail, cpf, cnpj todas ativas(Ajuda a evitar fraudes)
6. Salve as configurações.

## Frequently Asked Questions ##

### O que eu preciso para utilizar este plugin? ###

* Ter instalado o WooCommerce 2.0.x ou superior.
* Ter instalado o https://wordpress.org/plugins/woocommerce-extra-checkout-fields-for-brazil/
* Com a conta é possível gerar um Token em [Boleto Simples - API](https://boletosimples.com.br/conta/api);
* E configure a **URL para notificação** como por exemplo `http://seusite.com.br/?wc-api=WC_BoletoSimples_Gateway`;
* Pronto, conta configurada.

### O que é o Boleto Simples? ###

O Boleto Simples é um sistema que funciona na web, feito para que qualquer pessoa possa gerar boletos bancários e gerenciar suas cobranças. Com o Boleto Simples é possível cadastrar os dados da sua conta bancária que ele gera o boleto bancário para ser enviado para o cliente pagar.

### Quais são os pré-requisitos para usar o Boleto Simples? ###

Para usar o Boleto Simples é necessário:

1. Ter uma conta corrente ou poupança em banco;
2. Enviar documentação pessoal(CPF, ENDEREÇO e ETC.);
4. Possuir um computador com acesso à internet;

### Mais dúvidas de como funciona o Boleto Simples? ###

Acesse a [FAQ do Boleto Simples](http://suporte.boletosimples.com.br/hc/pt-br).


## For Developers ##

É possível usar qualquer um dos exemplos abaixo dentro do `functions.php` do seu tema ou criando um plugin (veja como em [WordPress - Writing a Plugin](http://codex.wordpress.org/Writing_a_Plugin)).

### Adicionar um ícone no método de pagamento: ###


	/**
	 * Adicionar um ícone para Boleto Simples.
	 *
	 * @param  string $url String vazia.
	 *
	 * @return string      Link para o seu ícone.
	 */
	function custom_woocommerce_boletosimples_icon( $url ) {
		return 'link do ícone';
	}

	add_filter( 'woocommerce_boletosimples_icon', 'custom_woocommerce_boletosimples_icon' );


### Alterar os parametros postados para o Boleto Simples: ###


	/**
	 * Customizar os dados postados para o Boleto Simples.
	 *
	 * @param  array    $data  Dados gerados pelo plugin.
	 * @param  WC_Order $order Objeto que contém todas as informações do pedido.
	 *
	 * @return array
	 */
	function custom_woocommerce_boletosimples_billet_data( $data, $order ) {
		// aqui você pode trabalhar e alterar o array $data com o que desejar.
		// Api do Boleto Simples: http://api.boletosimples.com.br

		return $data;
	}

	add_filter( 'woocommerce_boletosimples_billet_data', 'custom_woocommerce_boletosimples_billet_data', 10, 2 );


### Alterar as instruções do boleto na página de "obrigado" (thankyou page): ###


	/**
	 * Customizar as instruções sobre o boleto na página "obrigado".
	 *
	 * @param  string $message  Mensagem padrão do plugin.
	 * @param  int    $order_id ID do pedido.
	 *
	 * @return string           Novas instruções.
	 */
	function custom_woocommerce_boletosimples_thankyou_page_instructions( $message, $order_id ) {
		return 'Novas instruções';
	}

	add_filter( 'woocommerce_boletosimples_thankyou_page_instructions', 'custom_woocommerce_boletosimples_thankyou_page_instructions', 10, 2 );


### Alterar as instruções do boleto no e-mail: ###


	/**
	 * Customizar as instruções sobre o boleto no e-mail.
	 *
	 * @param  string   $message Mensagem padrão do plugin.
	 * @param  WC_Order $order   Objeto que contém todas as informações do pedido.
	 *
	 * @return string            Novas instruções.
	 */
	function custom_woocommerce_boletosimples_email_instructions( $message, $order ) {
		return 'Novas instruções';
	}

	add_filter( 'woocommerce_boletosimples_email_instructions', 'custom_woocommerce_boletosimples_email_instructions', 10, 2 );


### Alterar as instruções do boleto para pedidos que estão aguardando pagamento: ###


	/**
	 * Customizar as instruções do boleto para pedidos que estão aguardando pagamento.
	 *
	 * @param  string   $message Mensagem padrão do plugin.
	 * @param  WC_Order $order   Objeto que contém todas as informações do pedido.
	 *
	 * @return string            Novas instruções.
	 */
	function custom_woocommerce_boletosimples_pending_payment_instructions( $message, $order ) {
		return 'Novas instruções';
	}

	add_filter( 'woocommerce_boletosimples_pending_payment_instructions', 'custom_woocommerce_boletosimples_pending_payment_instructions', 10, 2 );


## Screenshots ##

### 1. Plugin Settings. ###
![1. Plugin Settings.](http://s.wordpress.org/extend/plugins/boletosimples-woocommerce/screenshot-1.png)


## Changelog ##

### 1.0.0 ###

* Versão inicial.

## Upgrade Notice ##


## License ##

Boleto Simples WooCommerce is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Boleto Simples WooCommerce is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Boleto Simples WooCommerce. If not, see <http://www.gnu.org/licenses/>.
