
import Web3 from "web3";

const RpcUrl = "https://holesky.infura.io/v3/65d869646c2d4517a9691b56caa97896"; // Vite's environment variable
const smartContractAddress = "0x0c8765d40bf555ccddacc993fe68ce0410e4f4a9";
const privateKey = "27ae78f1dee2c1b337f5abebbc36692991e4aebbaedf1b85ac2c83a2bda4e6dd";

// Set up Web3
const web3 = new Web3(new Web3.providers.HttpProvider(RpcUrl));

// Function to mint an NFT
export async function mintNFT(toAddress: string, metadataURI: string): Promise<string> {
    try {
        const account = web3.eth.accounts.privateKeyToAccount(privateKey);
        web3.eth.accounts.wallet.add(account);
        web3.eth.defaultAccount = account.address;

        // Load the contract ABI
        const contractAbi = await fetch("/abi.json").then((res) => res.json());
        const contract = new web3.eth.Contract(contractAbi, smartContractAddress);

        console.log("Minting NFT...");

        // Estimate gas
        const gas = await contract.methods.safeMint(toAddress, metadataURI).estimateGas({
            from: account.address,
        });

        console.log("Estimated gas:", gas);

        // Execute the mint transaction
        const tx = await contract.methods.safeMint(toAddress, metadataURI).send({
            from: account.address,
            gas,
        });

        console.log(`NFT minted successfully with transaction hash: ${tx.transactionHash}`);
        return tx.transactionHash;
    } catch (error) {
        console.error("Error minting NFT:", error);
        throw error;
    }
}

// Export a function to call mintNFT
export async function deployCert(certificteFileIpfs: string): Promise<string> {
    const recipientAddress = "0x8d80E7620Ff8d7d955daB5F7A97795725ffe40E4"; // Replace with recipient's Ethereum address
    return await mintNFT(recipientAddress, certificteFileIpfs);
}
