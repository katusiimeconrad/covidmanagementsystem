#include <netdb.h>
#include <netinet/in.h> 
#include <arpa/inet.h>
#include <unistd.h> 
#include <stdio.h> 
#include <stdlib.h> 
#include <string.h> 
#include <sys/socket.h> 
#define MAX 80 
#define PORT 8082
#define SA struct sockaddr 

void addPatient(int sockfd){


    char buff[60];//used to read data from socket
	char buff2[60];//used to write data to socket
    char buff3[255];//search terms.
	char fun[60];//choosing a function
	char *ptr = NULL;//a pointer to the function
    char delim[] = " ";// what to separate the functions by

    printf("          Welcome\n\
---------------------------------\n\
Addpatient FirstName LastName,date(Y-m-d),gender(M,F),category(Yes,No)\n\
Addpatient filename.txt \n\
get_statement\n\
Check_status\n\
Search criteria (name or date)\n\
exit\n\
---------------------------------\n");
    
    do{
        printf("Enter hospital code: ");//Prompts the health officer to enter the district code.
        fgets(buff2,50,stdin);
		write(sockfd, buff2, sizeof(buff2));//send to the server the district code captured from the health officer
        read(sockfd, buff, sizeof(buff));//read what is sent back from the server
        printf("%s\n", buff);//print what was returned
    }while(strcmp(buff,"invalid") == 0);
    
	do{
		printf("Enter Officer Name e.g (John Rubadiri): ");
		fgets(buff2,50,stdin);
		//scanf(" %s",buff2);//read the district code of the health official.
		write(sockfd, buff2, sizeof(buff2));
		read(sockfd, buff, sizeof(buff));
		printf("%s\n", buff);
	}while(strcmp(buff,"falseName") == 0);

	do{
		printf("Type function: ");
		fgets(buff,50,stdin);
		write(sockfd, buff, sizeof(buff));
		int len = strlen(buff);
		if(buff[len-1] == '\n')	
			buff[len-1] =0;
			strcpy(fun,buff);
		ptr = strtok(fun,delim);
		if(strcmp(fun,"Search")==0){
			printf("       Records     \n");
			read(sockfd, buff3, sizeof(buff3));
			printf("%s",buff3);
		}
		if(strcmp(buff,"Check_status")==0){
			read(sockfd, buff2, sizeof(buff2));
			printf("Cases: %s\n",buff2);
		}
   	}while(strcmp(buff,"exit") != 0);
  	printf("\nThank You and Good Bye\n");
}

int main() 	
{ 
	int sockfd, connfd; 
	struct sockaddr_in servaddr, cli; 

	// socket create and varification 
	sockfd = socket(AF_INET, SOCK_STREAM, 0); 
	if (sockfd == -1) { 
		printf("socket creation failed...\n"); 
		exit(0); 
	} 
	else
		printf("Socket successfully created..\n"); 
	bzero(&servaddr, sizeof(servaddr)); 

	// assign IP, PORT 
	servaddr.sin_family = AF_INET; 
	servaddr.sin_addr.s_addr = inet_addr("127.0.0.1"); 
	servaddr.sin_port = htons(PORT); 

	// connect the client socket to server socket 
	if (connect(sockfd, (SA*)&servaddr, sizeof(servaddr)) != 0) { 
		printf("connection with the server failed...\n"); 
		exit(0); 
	} 
	else
		printf("connected to the server..\n"); 
        //function to addmember
        addPatient(sockfd);

	// close the socket 
	close(sockfd); 
} 

