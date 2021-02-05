<?php
namespace Openpay\Library;

class Config {
  /**
   * @var $host string 访问地址
   */
  private $host;

  /**
   * @var string 商户扫码支付公网测试访问地址
   */
  private $dev_host = "https://weixinsupport.nbcb.com.cn/qrcode1/payOut.do";

  /**
   * @var string 商户扫码支付公网生产访问地址：
   */
  private $pro_host = "https://ipay.nbcb.com.cn/qrcode/payOut.do";

  /**
   * @var string 交易识别码 交易接口唯一识别码
   */
  public $tran_code;

  /**
   * @var int 易收宝分配的商户号
   */
  public $mchnt_cd;

  /**
   * @var string 商户下登记的员工号
   */
  public $staff_id;

  /**
   * @var string 登录号为门店用户时必输
   */
  public $shop_id;

  /**
   * @var string 商户或终端自行生成的订单流水号
   */
  public $trace_no;

  /**
   * @var string 商户原交易订单流水号
   */
  public $orig_trace_no;

  /**
   * @var string 原交易订单易收宝系统订单号
   */
  public $orig_out_trade_id;

  /**
   * @var string 退款交易的终端号
   */
  public $device_id;

  /**
   * @var string 易收宝系统订单号
   */
  public $out_trade_id;

  /**
   * @var int 交易金额 单位为分
   */
  public $total_fee;

  /**
   * @var string 设备读取的二维码或条码信息
   */
  public $auth_code;

  /**
   * @var string 请求签名 上送参数加签生成
   */
  public $sign;

  /**
   * @var string 支付结果通过异步回调地址
   */
  public $notify_url;

  /**
   * @var int 二维码有效时间 默认180s
   */
  public $time_out;

  /**
   * @var string 备注信息
   */
  public $remark;

  /**
   * @var int 退款金额，为空默认订单全额退款；不为空时按上送金额进行退款，单位为分
   */
  public $refund_fee;

  /**
   * @var string 易收宝公钥
   */
  public $public_key;

  /**
   * @var string 商户私钥
   */
  public $private_key;
  /**
   * @var int 定义请求环境 0：测试环境；1：生产环境
   */
  public $env;
}