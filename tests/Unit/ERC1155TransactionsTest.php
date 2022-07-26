<?php

namespace Igor360\NftEthPhpConnector\Tests\Unit;

use Igor360\NftEthPhpConnector\Connections\BaseCredentials;
use Igor360\NftEthPhpConnector\Contracts\ERC1155Contract;
use Igor360\NftEthPhpConnector\Contracts\ERC20Contract;
use Igor360\NftEthPhpConnector\Resources\ERC1155Resource;
use Igor360\NftEthPhpConnector\Resources\TransactionResource;
use Igor360\NftEthPhpConnector\Services\TransactionTokenService;
use Igor360\NftEthPhpConnector\Tests\TestCases;
use Igor360\NftEthPhpConnector\Tests\TestConstantsInterface;
use Igor360\NftEthPhpConnector\Transactions\ERC1155Transaction;

class ERC1155TransactionsTest extends TestCases
{
    public function testMintTokens(): void
    {
        $token = "0xe8ECDa4a231796C785D0D14444FfB2B143BD3338";
        $tokensReceiver = "0x07b8146Bb7629FAAE2886ecDB6E4e6B7d08eb788";
        $credentials = new BaseCredentials(TestConstantsInterface::RPC_HOST, TestConstantsInterface::RPC_PORT, true);
        $tokenResource = new ERC1155Resource($token, $credentials);
        $tokenTransaction = new ERC1155Transaction($tokenResource);
        $hash = $tokenTransaction->mint($tokensReceiver, 1, 1, TestConstantsInterface::KEY);
        $this->assertNotNull($hash);
    }

    public function testDecodeMintTransaction(): void
    {
        $hash = "0x12f602dcc28fe4a7377580bfedc964acaab3f401b6a5f8bc9968cdbb2937c598";
        $credentials = new BaseCredentials(TestConstantsInterface::RPC_HOST, TestConstantsInterface::RPC_PORT, true);
        $transactionResource = new TransactionResource($hash, $credentials);
        $transactionResource->setHandler(ERC1155Contract::class);
        $tokenService = new TransactionTokenService($transactionResource);
        $this->assertEquals("", $tokenService->getTransactionInfoJson());
    }
}