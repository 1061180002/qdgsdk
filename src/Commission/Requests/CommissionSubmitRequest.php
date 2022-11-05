<?php
/**
 * FileName:CommissionSubmit.php
 * Author:ZhangZhe
 * Email:1061180002@qq.com
 * Date:2022/6/30 0030
 * Time:15:06
 */
declare(strict_types=1);

namespace Huyingkeji\Qdgsdk\Commission\Requests;


use Huyingkeji\Qdgsdk\ApiReqInterface;

/**
 * NameSpace: HuYingKeJi\Qdgcommissionsdk\Apis
 * ClassName: CommissionSubmitRequest
 * 描述:提交佣金类
 */
class CommissionSubmitRequest implements ApiReqInterface {
	private array $apiParams = [];
	private string $uri = "/qdg/submit_commission";
	private CommissionSubmitItemRequest $commissionSubmitItemRequest;

	/**
	 * @return CommissionSubmitItemRequest
	 */
	public function getCommissionSubmitItemRequest(): CommissionSubmitItemRequest {
		return $this->commissionSubmitItemRequest;
	}

	/**
	 * @param CommissionSubmitItemRequest $commissionSubmitItemRequest
	 */
	public function setCommissionSubmitItemRequest(CommissionSubmitItemRequest $commissionSubmitItemRequest): void {
		$this->commissionSubmitItemRequest = $commissionSubmitItemRequest;
		$this->apiParams["commissionList"][] = $commissionSubmitItemRequest->jsonSerialize();
	}

	public function getApiParams(): array {
		return $this->apiParams;
	}

	public function getUri(): string {
		return $this->uri;
	}

	public function getHttpMethod(): string {
		return "post";
	}

	/**
	 * @param array $apiParams
	 */
	public function setApiParams(array $apiParams): void {
		$this->apiParams = $apiParams;
	}

	/**
	 * @param string $uri
	 */
	public function setUri(string $uri): void {
		$this->uri = $uri;
	}


}
